<?php

use Illuminate\Database\Seeder;

class RegulationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            \App\Models\Regulations::truncate();
            \App\Models\Regulations::insert([
                [
                    'title' => 'Нормативно-правовые акты',
                    'content' => 'Описание',
                    'is_active' => 1,
                    'lang' => 'ru',
                ],
                [
                    'title' => 'Regulations',
                    'content' => 'Descriptions',
                    'is_active' => 1,
                    'lang' => 'en',
                ],
            ]);
        } catch (Exception $ex) {
        }
    }
}
