<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Timeblock;

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
        echo "running...\n";
        $t=date('Y-m-d H:i:s');
        $day = date("l",strtotime($t));
        $time = date("H:i",strtotime($t));

        echo"Today its $day\nThe time is $time\n";
        $timeblock = Timeblock::select('litre')->where(['day' => $day, 'time'=>$time])->first();
        if($timeblock){
            echo "For this moment we have " . $timeblock->litre . " litre planned\n";
        }else{
            echo "There are no timeblocks\n";
        }
        echo "Job Finished!";
        return 0;
    }
}
