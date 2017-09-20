<?php

use Illuminate\Database\Seeder;

class InputOutputSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            \App\Models\InputOutput::truncate();
            \App\Models\InputOutput::insert([
                [
                    'input_title' => 'Пополнить счет',
                    'input_text' => '<p>Инструкция по вводу средств.</p>',
                    'output_title' => 'Вывести средства',
                    'output_text' => '<ol>
	<li>Заполнить профиль</li>
	<li>Подтвердить документы</li>
</ol>',
                    'need_show' => 1,
                    'lang' => 'ru',
                ],
                [
                    'input_title' => 'Fund your account',
                    'input_text' => '<p>Instructions for depositing funds.</p>',
                    'output_title' => 'Withdraw funds',
                    'output_text' => '<ol>
	<li>Fill profile</li>
	<li>Confirm documents</li>
</ol>',
                    'need_show' => 1,
                    'lang' => 'en',
                ],
            ]);
        } catch (Exception $ex) {
        }
    }
}
