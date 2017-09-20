<?php

use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            \App\Models\FAQ::truncate();
            \App\Models\FAQ::insert([
                [
                    'question' => 'Вопрос',
                    'answer' => 'Ответ',
                    'is_active' => 1,
                    'lang' => 'ru',
                ],
                [
                    'question' => 'Question',
                    'answer' => 'Answer',
                    'is_active' => 1,
                    'lang' => 'en',
                ],
            ]);
        } catch (Exception $ex) {
        }
    }
}
