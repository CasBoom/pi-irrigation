<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Timeblock;
use App\WateringLogs as Logs;

class checkSchedule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:schedule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Checks the schedule.\n
    If a timeblock exists at the current time, execute the pump command then write a new WateringLog to the DB";

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //time
        echo "running...\n";
        $t=date('Y-m-d H:i:s');
        $day = date("l",strtotime($t));
        $dayNumber = ((int)date("N",strtotime($t))-1)%7;
        echo "daynumber is $dayNumber\n";
        $time = date("H:i",strtotime($t));

        //settings
        $duration = 60;
        $lps = file_get_contents("../lps.txt");
        if(!$lps){
            //if the lps file doesnt exist, create and write 0
            $f = fopen('../lps.txt', 'wb');
            fputs($f, 0);
            fclose($f);
        }
        $interval = 1;

        echo"Today its $day\nThe time is $time\n";
        $timeblock = Timeblock::select('litre')->where(['day' => $dayNumber, 'time'=>$time])->first();

        if($timeblock){
            $litre = $timeblock->litre;

            $this->setup(env("PUMP_PIN"));

            echo "For this moment we have " . $litre . " litre planned\n";
            $timeout=0;
            $this->setGPIO(env("PUMP_PIN"), 1);

            //sleep for half  a second to let the motor spin up
            sleep(0.5);
            while($litre > 0 && $duration*$interval > $timeout){
                sleep($interval);
                $litre -= $lps*$interval;
                echo "$litre litre left\n";
                $new_lps = file_get_contents("../lps.txt");
                if(is_numeric($new_lps)){
                    $lps = $new_lps;
                }
                $timeout++;
            }
            $this->setGPIO(env("PUMP_PIN"), 0);
            Logs::insert(
                ["time" => $t,
                "litre" => $timeblock->litre - $litre,
                "success" => $litre<0.1]);
        }else{
            echo "There are no timeblocks\n";
        }
        echo "Job Finished!";
        return 0;
    }
    public function setup($gpio){
        shell_exec("/usr/bin/sudo echo \"$gpio\" > /sys/class/gpio/export");
        echo "/usr/bin/sudo echo \"$gpio\" > /sys/class/gpio/export\n";
        shell_exec("/usr/bin/sudo echo \"out\" > /sys/class/gpio/gpio$gpio/direction");
        echo "/usr/bin/sudo echo \"out\" > /sys/class/gpio/gpio$gpio/direction";
    }

    public function setGPIO($gpio, $bool){
        shell_exec("/usr/bin/sudo echo \"$bool\" > /sys/class/gpio/gpio$gpio/value");
        echo("/usr/bin/sudo echo \"$bool\" > /sys/class/gpio/gpio$gpio/value\n");
    }
}
