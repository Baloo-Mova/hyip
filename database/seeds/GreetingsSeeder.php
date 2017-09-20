<?php

use Illuminate\Database\Seeder;

class GreetingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            \App\Models\MainPage\Greetings::insert([
                [
                    'image' => '150589720525f445c4.jpg',
                    'main_title' => 'Добро пожаловать',
                    'sub_title' => 'Заголовок на русском',
                    'description' => 'Текст на руском. Lorem ipsum dolor sit amet, consectetur adipisicing elit. At, ex facere fugiat maxime molestiae non nostrum o Lorem ipsum dolor sit amet, consectetur adipisicing elit. At, ex facere fugiat maxime molestiae non nostrum o Lorem ipsum dolor sit amet, consectetur adipisicing elit. At, ex facere fugiat maxime molestiae non nostrum.',
                    'lang' => 'ru',
                ],
                [
                    'image' => '150589720525f445c4.jpg',
                    'main_title' => 'WELCOME TO LARAVEL',
                    'sub_title' => 'Trust Management',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. At, ex facere fugiat maxime molestiae non nostrum o Lorem ipsum dolor sit amet, consectetur adipisicing elit. At, ex facere fugiat maxime molestiae non nostrum o Lorem ipsum dolor sit amet, consectetur adipisicing elit. At, ex facere fugiat maxime molestiae non nostrum.',
                    'lang' => 'en',
                ],
            ]);
        } catch (Exception $ex) {
        }
    }
}
