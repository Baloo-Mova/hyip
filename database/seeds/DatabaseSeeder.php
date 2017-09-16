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
        $this->call(social_networks_share::class);
        try {
            \App\Models\WalletProcessesType::insert([
                'id' => 1,
                'name' => 'Рефферальные начисления'
            ]);
        } catch (Exception $ex) {
        }

        try {
            \App\Models\WalletProcessesType::insert([
                'id' => 2,
                'name' => 'Пополнение'
            ]);
        } catch (Exception $ex) {
        }

        try {
            \App\Models\WalletProcessesType::insert([
                'id' => 3,
                'name' => 'Вывод'
            ]);
        } catch (Exception $ex) {
        }
    }
}
