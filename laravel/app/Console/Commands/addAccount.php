<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\hash;

class addAccount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:account {username} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a new account';

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
        $username = $this->argument('username');
        $password = $this->argument('password');
        DB::table('users')->insert(['name' => $username, 'email'=>$username."@gmail.com", 'password' => Hash::make($password)]);
        echo "Create user: $username";
    }
}
