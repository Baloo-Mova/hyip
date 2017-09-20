<?php

use Illuminate\Database\Seeder;

class ThreeStepsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            \App\Models\MainPage\ThreeSteps::insert([
                    [
                        'main_title' => '3 шага, чтобы начать зарабатывать',
                        'first_title' => '<a href="http://hyip.simplewaysolution.com" class="about__link"><span>Зарегистрируйте аккаунт</span></a><span>&nbsp;и выберите инвестиционный портфель</span>',
                        'first_text' => 'На нашем веб-сайте вы можете найти удобную регистрационную форму, состоящую из нескольких простых полей. На всякий случай, мы используем специальные технологии, чтобы исправить любую вашу регистрационную ошибку, даже преднамеренную.',
                        'second_title' => 'Выберите инвестиционный портфель, который соответствует вашим потребностям',
                        'second_text' => 'В бэк-офисе просмотрите список инвестиционных портфелей и выберите один для инвестиций.',
                        'third_title' => 'Сфокусировуйте счет удобным способом и купите портфель',
                        'third_text' => 'Вы можете легко внести депозит на свой счет через банковский перевод или электронные платежные системы.',
                        'lang' => 'ru'
                    ],
                    [
                        'main_title' => '3 steps to start earning',
                        'first_title' => '<a href="http://hyip.simplewaysolution.com" class="about__link"><span class="js-translate">Register an account</span></a><span>&nbsp;and choose an investment portfolio</span>',
                        'first_text' => 'On our website, you can find a convenient registration form consisting of several simple fields. Just in case, we use special technologies to correct any of your registration mistakes, even intentional.',
                        'second_title' => 'Choose an investment portfolio that fits your needs',
                        'second_text' => 'Once in the back office, review the list of investment portfolios and choose one to invest in.',
                        'third_title' => 'Fund the account in a convenient way and buy a portfolio',
                        'third_text' => 'You can easily make a deposit to your account via bank transfer or electronic payment systems.',
                        'lang' => 'en'
                    ]
                ]);
        } catch (Exception $ex) {
        }
    }
}
