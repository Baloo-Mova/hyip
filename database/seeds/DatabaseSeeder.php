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
        $this->call(AboutProjectSeeder::class);
        $this->call(ThreeStepsSeeder::class);
        $this->call(GreetingsSeeder::class);
        $this->call(CarouselSeeder::class);
        $this->call(FaqSeeder::class);
        $this->call(ArticlesSeeder::class);
        $this->call(AboutSeeder::class);
        $this->call(RegulationsSeeder::class);
        $this->call(InputOutputSeeder::class);
        $this->call(SettingsSeed::class);
        $this->call(DocumentsSeeder::class);
        try {
            \App\Models\WalletProcessesType::truncate();
            \App\Models\WalletProcessesType::insert([
                [
                    'id' => 1,
                    'name' => 'Рефферальные начисления'
                ],
                [
                    'id' => 2,
                    'name' => 'Ввод средств'
                ],
                [
                    'id' => 3,
                    'name' => 'Вывод средств'
                ],
                [
                    'id' => 4,
                    'name' => 'Бонус'
                ]
            ]);
        } catch (Exception $ex) {
        }
    }
}
