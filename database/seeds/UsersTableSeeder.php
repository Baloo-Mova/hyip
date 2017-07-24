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
        DB::table('users')->delete();

        \App\Models\User::create(
            [
                'login'             => 'login',
                'email'             => 'ad@min.dev',
                'password'          => bcrypt('password'),
                'remember_token'    => str_random(10),
                'role'              => 2,
                'balance'           => 0,
                'ref_link'          => 'admin',
                'last_activity'     => \Carbon\Carbon::now(),
            ]
        );
    }
}
