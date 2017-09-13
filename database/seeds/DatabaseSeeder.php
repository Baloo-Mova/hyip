<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        try {
            \App\Models\WalletProcessesType::insert([
                'id' => 1,
                'name' => 'Рефферальные начисления'
            ]);
        } catch (Exception $ex) {
        }
    }
}
