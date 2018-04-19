<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      //  factory(\App\Models\User::class, 10000)->create();
//        DB::table('users')->delete();
//
        try {
            \App\Models\User::create(
                [
                    'login' => 'login',
                    'email' => 'ad@min.dev',
                    'password' => bcrypt('password'),
                    'remember_token' => str_random(10),
                    'role' => 2,
                    'balance' => 0,
                    'ref_link' => 'admin',
                    'last_activity' => \Carbon\Carbon::now(),
                    'ip' => '127.0.0.1'
                ]
            );
        }catch (Exception $ex){}
    }
}
