<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ['firstname'=> 'Ash', 'middlename'=> "A", 'lastname'=> Str::random(10), 'type'=> 'admin', 'password'=> bcrypt('test')],
            ['firstname'=> 'Ben', 'middlename'=> "B", 'lastname'=> Str::random(10), 'type'=> 'student', 'password'=> bcrypt('test')],
            ['firstname'=> 'Charles', 'middlename'=> "C", 'lastname'=> Str::random(10), 'type'=> 'student', 'password'=> bcrypt('test')],
            ['firstname'=> 'Darwin', 'middlename'=> "D", 'lastname'=> Str::random(10), 'type'=> 'staff', 'password'=> bcrypt('test')],
            ['firstname'=> 'Earl', 'middlename'=> "E", 'lastname'=> Str::random(10), 'type'=> 'staff', 'password'=> bcrypt('test')]
        ];
        foreach($users as $user){
            $user['email'] = $user['lastname'].'@gmail.com';
            DB::table('users')->insert($user);
        }
    }
}
