<?php

use Illuminate\Database\Seeder;

class CarouselSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            \App\Models\MainPage\HeaderCarousel::truncate();
            \App\Models\MainPage\HeaderCarousel::insert([
                [
                    'background_file' => 'noimg.jpg',
                    'text' => 'Грамотно выстроенная маркетинговая система позволяет заработать всем',
                    'need_show' => 1,
                    'buttons' => '[{"text":"\u0420\u0435\u0433\u0438\u0441\u0442\u0440\u0430\u0446\u0438\u044f","url":"register"}]',
                    'lang' => 'ru',
                ],
                [
                    'background_file' => 'noimg.jpg',
                    'text' => 'Информация о перспективах сотрудничества с компанией, о выгоде клиентов',
                    'need_show' => 1,
                    'buttons' => '[{"text":"\u0420\u0435\u0433\u0438\u0441\u0442\u0440\u0430\u0446\u0438\u044f","url":"register"},{"text":"\u0423\u0437\u043d\u0430\u0442\u044c \u043a\u0430\u043a","url":"about"}]',
                    'lang' => 'ru',
                ],
                [
                    'background_file' => 'noimg.jpg',
                    'text' => 'Ничего не надо продавать или покупать, просто делайте деньги',
                    'need_show' => 1,
                    'buttons' => '[{"text":"\u0420\u0435\u0433\u0438\u0441\u0442\u0440\u0430\u0446\u0438\u044f","url":"register"},{"text":"\u041f\u043e\u0434\u0440\u043e\u0431\u043d\u0435\u0435","url":"about"}]',
                    'lang' => 'ru',
                ],
                [
                    'background_file' => 'noimg.jpg',
                    'text' => 'A competently built marketing system allows you to earn everyone',
                    'need_show' => 1,
                    'buttons' => '[{"text":"Register","url":"register"}]',
                    'lang' => 'en',
                ],
                [
                    'background_file' => 'noimg.jpg',
                    'text' => 'Information on the prospects for cooperation with the company, about the benefits of customers',
                    'need_show' => 1,
                    'buttons' => '[{"text":"Register","url":"register"},{"text":"Learn how","url":"about"}]',
                    'lang' => 'en',
                ],
                [
                    'background_file' => 'noimg.jpg',
                    'text' => 'Nothing to sell or buy, just make money',
                    'need_show' => 1,
                    'buttons' => '[{"text":"Register","url":"register"},{"text":"More info","url":"about"}]',
                    'lang' => 'en',
                ],
            ]);
        } catch (Exception $ex) {
        }
    }
}
