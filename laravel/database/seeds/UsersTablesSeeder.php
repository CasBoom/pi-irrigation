<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class UsersTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $words = ["Panda", "Plant", "Leaves", "Solar", "Life", "Bamboo", "Green", "Cat", "Energy", "Bio"];
        $username =  $words[rand(0,count($words)-1)]."Admin".rand(0,count($words)-1);
        $password =  $words[rand(0,count($words)-1)].$words[rand(0,count($words)-1)].rand(0,9).rand(0,9).rand(0,9).rand(0,9);
        print("the admin login credentials are: \n Username: $username \n Password: $password\n");

        DB::table('users')->insert(['name' => $username, 'email'=>$username."@gmail.com", 'password' => Hash::make($password)]);
    }
}
