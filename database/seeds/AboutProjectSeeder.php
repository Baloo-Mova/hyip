<?php

use Illuminate\Database\Seeder;

class AboutProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            \App\Models\MainPage\AboutProject::insert([
                [
                    'image' => '15058969421bff03673.jpg',
                    'title' => 'Вы ничем не рискуете',
                    'description' => 'Да, вам не показалось. Разве 400-500 рублей на сегодняшний день – это большие деньги? Подумайте, что можно на них приобрести, а затем сравните с теми возможностями, какие открывает вам White Coin. Например, сегодня вы оплатили подписку за 499 рублей. За месяц пригласили 10 человек и заработали минимум 3000 рублей. Чистыми получается 2501 рубль. Чтобы работать с нами дальше и в следующем месяце снова получить 3000 рублей с этих же людей, вам необходимо продлить подписку. И вы будете оплачивать ее уже не из своего кармана, а из заработанных денег. То есть уже никаких вложений делать не придется.',
                    'lang' => 'ru',
                ],
                [
                    'image' => '15058969421bff03673.jpg',
                    'title' => 'Бонусная программа',
                    'description' => 'Как только ваша структура вырастет до 1000 человек на трех ступенях, то вы можете получить от нас дополнительный бонус 10 000 рублей и будете получать его ежемесячно вместе с основными партнерскими вознаграждениями. А когда ваша структура достигнет количества в 10 000 человек на трех ступенях, то мы подарим вам 100 000 рублей! И этот бонус также вы будете получать ежемесячно. Чтобы более подробно узнать, как получать такие бонусы, проходите в раздел «Акции».',
                    'lang' => 'ru',
                ],
                [
                    'image' => '15058969421bff03673.jpg',
                    'title' => 'Большие перспективы развития',
                    'description' => 'Начав сотрудничество с нами сейчас, на старте, вы обрекаете себя на успех! У нашей компании большие перспективы развития и большие планы. Мы планируем расширять количество тарифов, увеличивать глубину реферальной системы, вводить дополнительные бонусы и создавать благоприятные условия для наших партнеров, чтобы все могли зарабатывать легко и просто. Быть одним из первых в нашей компании – значит сорвать большой куш!',
                    'lang' => 'ru',
                ],
                [
                    'image' => '15058969421bff03673.jpg',
                    'title' => '0% комиссии за пополнение и вывод средств',
                    'description' => 'Мы не берем с вас никаких комиссий за пополнение или снятие средств',
                    'lang' => 'ru',
                ],
                [
                    'image' => '15058969421bff03673.jpg',
                    'title' => 'Множество способов оплаты',
                    'description' => 'Для вашего удобства, мы подключили различные способы оплаты. Но мы не останавливаемся на достигнутом и будем совершенствовать систему оплат постоянно, чтобы вам было еще удобнее работать с нами.',
                    'lang' => 'ru',
                ],
                [
                    'image' => '15058969421bff03673.jpg',
                    'title' => 'You risk nothing',
                    'description' => 'Yes, you did not seem. Unless 400-500 rubles for today is a big money? Think about what you can buy from them, and then compare with the opportunities that White Coin offers you. For example, today you paid a subscription for 499 rubles. For a month, invited 10 people and earned a minimum of 3000 rubles. Clean turns 2501 rubles. To work with us further and in the next month again to get 3000 rubles from these same people, you need to renew your subscription. And you will pay it no longer out of your pocket, but from the money you earn. That is, no investment will have to be made.',
                    'lang' => 'en',
                ],
                [
                    'image' => '15058969421bff03673.jpg',
                    'title' => 'Bonus program',
                    'description' => 'Once your structure grows to 1000 people on three levels, then you can receive from us an additional bonus of 10 000 rubles and you will receive it every month along with the main partner rewards. And when your structure reaches the number of 10,000 people on three levels, then we will give you 100,000 rubles! And this bonus will also be paid monthly. To learn more about how to receive these bonuses, go to the "Promotions" section.',
                    'lang' => 'en',
                ],
                [
                    'image' => '15058969421bff03673.jpg',
                    'title' => 'Great prospects for development',
                    'description' => 'Having started cooperation with us now, at the start, you doom yourself to success! Our company has great prospects for development and big plans. We plan to expand the number of tariffs, increase the depth of the referral system, introduce additional bonuses and create favorable conditions for our partners, so that everyone can earn easily and simply. To be one of the first in our company is to break a big jackpot!',
                    'lang' => 'en',
                ],
                [
                    'image' => '15058969421bff03673.jpg',
                    'title' => '0% commission for replenishment and withdrawal of funds',
                    'description' => 'We do not charge you any commission for replenishment or withdrawal of funds',
                    'lang' => 'en',
                ],
                [
                    'image' => '15058969421bff03673.jpg',
                    'title' => 'Many payment methods',
                    'description' => 'For your convenience, we have connected various payment methods. But we do not stop there and will improve the payment system constantly, so that it would be even more convenient for you to work with us.',
                    'lang' => 'en',
                ],
            ]);
        } catch (Exception $ex) {
        }
    }
}
