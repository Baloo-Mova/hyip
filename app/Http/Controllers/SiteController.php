<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;

class SiteController extends Controller
{
    public function index(){
        $subscriptions = Subscription::with(['firstPrices'])->get()->toArray();

        $data = [
            'carousel' => [
              [
                  'img' => 'img/1.jpg',
                  'caption' => 'Грамотно выстроенная маркетинговая система позволяет заработать всем',
                  'buttons' => [
                      [
                          'title' => 'Регистрация',
                          'link'  => '/register',
                          'class' => 'btn-main-carousel btn-flat btn-lg'
                      ]
                  ]
              ],
              [
                  'img' => 'img/2.jpg',
                  'caption' => 'Содержит информацию о перспективах сотрудничества с компанией, о выгоде клиентов',
                  'buttons' => [
                      [
                          'title' => 'Регистрация',
                          'link'  => '/register',
                          'class' => 'btn-main-carousel btn-flat btn-lg'
                      ],
                      [
                          'title' => 'Узнать как',
                          'link'  => '/register',
                          'class' => 'btn-main-carousel btn-flat btn-lg'
                      ]
                  ]
              ],
              [
                  'img' => 'img/3.jpg',
                  'caption' => 'Ничего не надо продавать или покупать, просто делайте деньги',
                  'buttons' => [
                      [
                          'title' => 'Регистрация',
                          'link'  => '/register',
                          'class' => 'btn-main-carousel btn-flat btn-lg'
                      ],
                      [
                          'title' => 'Подробнее',
                          'link'  => '/register',
                          'class' => 'btn-main-carousel btn-flat btn-lg'
                      ]
                  ]
              ],
            ],
            'greetings' => [
                'img' => 'img/1.jpg',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. At, ex facere fugiat maxime molestiae non nostrum o Lorem ipsum dolor sit amet, consectetur adipisicing elit. At, ex facere fugiat maxime molestiae non nostrum o Lorem ipsum dolor sit amet, consectetur adipisicing elit. At, ex facere fugiat maxime molestiae non nostrum o'
            ],
            'about' => [
                [
                    'img' => 'img/1.jpg',
                    'title' => 'Вы ничем не рискуете',
                    'description' => 'Да, вам не показалось. Разве 400-500 рублей на сегодняшний день – это большие деньги? Подумайте, что можно на них приобрести, а затем сравните с теми возможностями, какие открывает вам White Coin. Например, сегодня вы оплатили подписку за 499 рублей. За месяц пригласили 10 человек и заработали минимум 3000 рублей. Чистыми получается 2501 рубль. Чтобы работать с нами дальше и в следующем месяце снова получить 3000 рублей с этих же людей, вам необходимо продлить подписку. И вы будете оплачивать ее уже не из своего кармана, а из заработанных денег. То есть уже никаких вложений делать не придется.',
                    'link' => '#'
                ],
                [
                    'img' => 'img/2.jpg',
                    'title' => 'Бонусная программа',
                    'description' => 'Как только ваша структура вырастет до 1000 человек на трех ступенях, то вы можете получить от нас дополнительный бонус 10 000 рублей и будете получать его ежемесячно вместе с основными партнерскими вознаграждениями. А когда ваша структура достигнет количества в 10 000 человек на трех ступенях, то мы подарим вам 100 000 рублей! И этот бонус также вы будете получать ежемесячно. Чтобы более подробно узнать, как получать такие бонусы, проходите в раздел «Акции».',
                    'link' => '#'
                ],
                [
                    'img' => 'img/3.jpg',
                    'title' => 'Большие перспективы развития',
                    'description' => 'Начав сотрудничество с нами сейчас, на старте, вы обрекаете себя на успех! У нашей компании большие перспективы развития и большие планы. Мы планируем расширять количество тарифов, увеличивать глубину реферальной системы, вводить дополнительные бонусы и создавать благоприятные условия для наших партнеров, чтобы все могли зарабатывать легко и просто. Быть одним из первых в нашей компании – значит сорвать большой куш!',
                    'link' => '#'
                ],
                [
                    'img' => 'img/1.jpg',
                    'title' => '0% комиссии за пополнение и вывод средств',
                    'description' => 'Мы не берем с вас никаких комиссий за пополнение или снятие средств',
                    'link' => '#'
                ],
                [
                    'img' => 'img/2.jpg',
                    'title' => 'Множество способов оплаты',
                    'description' => 'Для вашего удобства, мы подключили различные способы оплаты. Но мы не останавливаемся на достигнутом и будем совершенствовать систему оплат постоянно, чтобы вам было еще удобнее работать с нами.',
                    'link' => '#'
                ],
            ],
            'rate' => $subscriptions,
            'paysystems' => [
                'img/brand3.png',
                'img/brand7.png',
                'img/brand2.png',
                'img/brand6.png',
                'img/brand9.png',
            ],
            'news' => [
                ['title' => 'Новость 1', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. At, ex facere fugiat maxime molestiae non nostrum o', 'link' => 'http://google.com.ua'],
                ['title' => 'Новость 2', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. At, ex facere fugiat maxime molestiae non nostrum o', 'link' => 'http://google.com.ua'],
                ['title' => 'Новость 3', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. At, ex facere fugiat maxime molestiae non nostrum o', 'link' => 'http://google.com.ua']
            ],
            'contacts' =>[
                'phones' => [
                    '+380661234567',
                    '+380661234567',
                    '+380661234567'
                ],
                'emails' => [
                    'email1@gmail.com',
                    'email2@gmail.com',
                    'email3@gmail.com',
                ],
                'social' => [
                    'links' => [
                        'vk' => [
                            'img' => 'img/vk', 'link' => 'http://google.com.ua'
                        ],
                        'instagram' => [
                            'img' => 'img/instagram', 'link' => 'http://google.com.ua'
                        ]
                    ],
                    'share' => [
                        'vk' => [
                            'img' => 'img/vk', 'link' => 'http://google.com.ua'
                        ],
                        'fb' => [
                            'img' => 'img/fb', 'link' => 'http://google.com.ua'
                        ],
                        'ok' => [
                            'img' => 'img/ok', 'link' => 'http://google.com.ua'
                        ],
                        'tw' => [
                            'img' => 'img/tw', 'link' => 'http://google.com.ua'
                        ],
                        'tl' => [
                            'img' => 'img/tl', 'link' => 'http://google.com.ua'
                        ],
                        'instagram' => [
                            'img' => 'img/instagram', 'link' => 'http://google.com.ua'
                        ]
                    ]
                ]
            ]
        ];
        return view('main.index', ['data' => $data]);
    }

    public function about()
    {
        $data = [
            'contacts' =>[
                'social' => [
                    'links' => [
                        'vk' => [
                            'img' => 'img/vk', 'link' => 'http://google.com.ua'
                        ],
                        'instagram' => [
                            'img' => 'img/instagram', 'link' => 'http://google.com.ua'
                        ]
                    ],
                    'share' => [
                        'vk' => [
                            'img' => 'img/vk', 'link' => 'http://google.com.ua'
                        ],
                        'fb' => [
                            'img' => 'img/fb', 'link' => 'http://google.com.ua'
                        ],
                        'ok' => [
                            'img' => 'img/ok', 'link' => 'http://google.com.ua'
                        ],
                        'tw' => [
                            'img' => 'img/tw', 'link' => 'http://google.com.ua'
                        ],
                        'tl' => [
                            'img' => 'img/tl', 'link' => 'http://google.com.ua'
                        ],
                        'instagram' => [
                            'img' => 'img/instagram', 'link' => 'http://google.com.ua'
                        ]
                    ]
                ]
            ]
        ];
        return view('main.about', ['data' => $data]);
    }

    public function news()
    {
        $data = [
            'contacts' =>[
                'social' => [
                    'links' => [
                        'vk' => [
                            'img' => 'img/vk', 'link' => 'http://google.com.ua'
                        ],
                        'instagram' => [
                            'img' => 'img/instagram', 'link' => 'http://google.com.ua'
                        ]
                    ],
                    'share' => [
                        'vk' => [
                            'img' => 'img/vk', 'link' => 'http://google.com.ua'
                        ],
                        'fb' => [
                            'img' => 'img/fb', 'link' => 'http://google.com.ua'
                        ],
                        'ok' => [
                            'img' => 'img/ok', 'link' => 'http://google.com.ua'
                        ],
                        'tw' => [
                            'img' => 'img/tw', 'link' => 'http://google.com.ua'
                        ],
                        'tl' => [
                            'img' => 'img/tl', 'link' => 'http://google.com.ua'
                        ],
                        'instagram' => [
                            'img' => 'img/instagram', 'link' => 'http://google.com.ua'
                        ]
                    ]
                ]
            ]
        ];
        return view('main.news', ['data' => $data]);
    }

    public function contacts()
    {
        $data = [
            'contacts' =>[
                'social' => [
                    'links' => [
                        'vk' => [
                            'img' => 'img/vk', 'link' => 'http://google.com.ua'
                        ],
                        'instagram' => [
                            'img' => 'img/instagram', 'link' => 'http://google.com.ua'
                        ]
                    ],
                    'share' => [
                        'vk' => [
                            'img' => 'img/vk', 'link' => 'http://google.com.ua'
                        ],
                        'fb' => [
                            'img' => 'img/fb', 'link' => 'http://google.com.ua'
                        ],
                        'ok' => [
                            'img' => 'img/ok', 'link' => 'http://google.com.ua'
                        ],
                        'tw' => [
                            'img' => 'img/tw', 'link' => 'http://google.com.ua'
                        ],
                        'tl' => [
                            'img' => 'img/tl', 'link' => 'http://google.com.ua'
                        ],
                        'instagram' => [
                            'img' => 'img/instagram', 'link' => 'http://google.com.ua'
                        ]
                    ]
                ]
            ]
        ];
        return view('main.contacts', ['data' => $data]);
    }

    public function questions()
    {
        $data = [
            'contacts' =>[
                'social' => [
                    'links' => [
                        'vk' => [
                            'img' => 'img/vk', 'link' => 'http://google.com.ua'
                        ],
                        'instagram' => [
                            'img' => 'img/instagram', 'link' => 'http://google.com.ua'
                        ]
                    ],
                    'share' => [
                        'vk' => [
                            'img' => 'img/vk', 'link' => 'http://google.com.ua'
                        ],
                        'fb' => [
                            'img' => 'img/fb', 'link' => 'http://google.com.ua'
                        ],
                        'ok' => [
                            'img' => 'img/ok', 'link' => 'http://google.com.ua'
                        ],
                        'tw' => [
                            'img' => 'img/tw', 'link' => 'http://google.com.ua'
                        ],
                        'tl' => [
                            'img' => 'img/tl', 'link' => 'http://google.com.ua'
                        ],
                        'instagram' => [
                            'img' => 'img/instagram', 'link' => 'http://google.com.ua'
                        ]
                    ]
                ]
            ]
        ];
        return view('main.questions', ['data' => $data]);
    }

    public function regulations()
    {
        $data = [
            'contacts' =>[
                'social' => [
                    'links' => [
                        'vk' => [
                            'img' => 'img/vk', 'link' => 'http://google.com.ua'
                        ],
                        'instagram' => [
                            'img' => 'img/instagram', 'link' => 'http://google.com.ua'
                        ]
                    ],
                    'share' => [
                        'vk' => [
                            'img' => 'img/vk', 'link' => 'http://google.com.ua'
                        ],
                        'fb' => [
                            'img' => 'img/fb', 'link' => 'http://google.com.ua'
                        ],
                        'ok' => [
                            'img' => 'img/ok', 'link' => 'http://google.com.ua'
                        ],
                        'tw' => [
                            'img' => 'img/tw', 'link' => 'http://google.com.ua'
                        ],
                        'tl' => [
                            'img' => 'img/tl', 'link' => 'http://google.com.ua'
                        ],
                        'instagram' => [
                            'img' => 'img/instagram', 'link' => 'http://google.com.ua'
                        ]
                    ]
                ]
            ]
        ];
        return view('main.regulations', ['data' => $data]);
    }
}
