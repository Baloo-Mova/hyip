<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Article;
use App\Models\Contact;
use App\Models\FAQ;
use App\Models\SocialNetwork;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Subscription;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class SiteController extends Controller
{
    public function needVerifyEmail()
    {
        return view('guest.need_verify_email');
    }

    public function index()
    {
        $subscriptions = Subscription::with(['firstPrices'])->get()->toArray();
        $social = SocialNetwork::link()->get();
        $shares = SocialNetwork::share()->get();
        $news = Article::orderBy('updated_at', 'asc')->limit(3)->get();
        $email = Contact::email()->get();
        $phones = Contact::phones()->get();
        $data = [
            'carousel' => [
                [
                    'img' => 'img/1.jpg',
                    'caption' => 'Грамотно выстроенная маркетинговая система позволяет заработать всем',
                    'buttons' => [
                        [
                            'title' => 'Регистрация',
                            'link' => route('register'),
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
                            'link' => route('register'),
                            'class' => 'btn-main-carousel btn-flat btn-lg'
                        ],
                        [
                            'title' => 'Узнать как',
                            'link' => route('about'),
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
                            'link' => route('register'),
                            'class' => 'btn-main-carousel btn-flat btn-lg'
                        ],
                        [
                            'title' => 'Подробнее',
                            'link' => route('about'),
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
                    'link' => route('stock')
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
            'news' => $news,
            'contacts' => [
                'phones' => $phones,
                'emails' => $email,
                'social' => [
                    'links' => $social,
                    'share' => $shares
                ]
            ]
        ];
        return view('main.index', ['data' => $data]);
    }

    public function addReferral($id)
    {
        $user = User::where('ref_link', '=', $id)->first();
        if (isset($user)) {
            return redirect(route('index'))->withCookies([
                Cookie::make('referralId', $user->id, 120)
            ]);
        }

        return redirect(route('index'));
    }

    public function about()
    {
        $content = About::where(['id' => 1, 'is_active' => 1])->first();
        $social = SocialNetwork::link()->get();
        $data = [
            'contacts' => [
                'social' => [
                    'links' => $social
                ]
            ]
        ];
        return view('main.about', [
            'data' => $data,
            'content' => isset($content) ? $content : []
        ]);
    }

    public function tariff($id)
    {
        $tariffs = Subscription::with(['firstPrices'])->get();
        $tariff = Subscription::find($id);
        $social = SocialNetwork::link()->get();
        if (isset($tariff)) {
            $subscriptionPrices = $tariff->firstPrices;
        }
        $data = [
            'contacts' => [
                'social' => [
                    'links' => $social
                ]
            ]
        ];
        return view('main.tariff', [
            'data' => $data,
            'tariffs' => $tariffs,
            'tariff_info' => isset($tariff) ? $tariff : "",
            "subscription" => isset($subscriptionPrices) ? $subscriptionPrices : ""
        ]);
    }

    public function inputOutput($type)
    {
        $social = SocialNetwork::link()->get();
        $data = [
            'input' => [
                'title' => 'Пополнить счет',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
            ],
            'output' => [
                'title' => 'Вывести стредства',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
            ],
            'contacts' => [
                'social' => [
                    'links' => $social
                ]
            ]
        ];
        return view('main.inputOutput', ['data' => $data, 'type' => $type]);
    }

    public function stock()
    {
        $social = SocialNetwork::link()->get();
        $stock = Article::stock()->orderBy('updated_at', 'asc')->paginate(10);
        $data = [
            'stock' => $stock,
            'contacts' => [
                'social' => [
                    'links' => $social,
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
        return view('main.stock', ['data' => $data]);
    }

    public function stockShow($uri)
    {
        $social = SocialNetwork::link()->get();
        $stock = Article::whereUri($uri)->first();
        if(!isset($stock)){
            return redirect(route('stock'))
                ->withErrors('Записи с таким ID не существует!')
                ->withInput();
        }
        $data = [
            'article' => $stock,
            'contacts' => [
                'social' => [
                    'links' => $social
                ]
            ]
        ];
        return view('main.article', ['data' => $data]);
    }

    public function newsShow($uri)
    {
        $news = Article::whereUri($uri)->first();
        $social = SocialNetwork::link()->get();
        if(!isset($news)){
            return redirect(route('news'))
                ->withErrors('Записи с таким ID не существует!')
                ->withInput();
        }
        $data = [
            'article' => $news,
            'contacts' => [
                'social' => [
                    'links' => $social
                ]
            ]
        ];
        return view('main.article', ['data' => $data]);
    }

    public function news()
    {
        $social = SocialNetwork::link()->get();
        $news = Article::blog()->orderBy('updated_at', 'asc')->paginate(10);
        $data = [
            'news' => $news,
            'contacts' => [
                'social' => [
                    'links' => $social
                ]
            ]
        ];
        return view('main.news', ['data' => $data]);
    }

    public function contacts()
    {
        $social = SocialNetwork::link()->get();
        $shares = SocialNetwork::share()->get();
        $email = Contact::email()->get();
        $phones = Contact::phones()->get();
        $data = [
            'contacts' => [
                'social' => [
                    'links' => $social,
                    'share' => $shares
                ],
                'emails' => $email,
                'phones' => $phones
            ]
        ];
        return view('main.contacts', ['data' => $data]);
    }

    public function questions()
    {
        $faq = FAQ::paginate(15);
        $social = SocialNetwork::link()->get();

        $data = [
            'contacts' => [
                'social' => [
                    'links' => $social
                ]
            ]
        ];

        return view('main.questions', [
            'data' => $data,
            'faq'  => $faq
        ]);
    }

    public function regulations()
    {
        $social = SocialNetwork::link()->get();
        $data = [
            'contacts' => [
                'social' => [
                    'links' => $social
                ]
            ]
        ];
        return view('main.regulations', ['data' => $data]);
    }

    public function termsOfUse()
    {
        $social = SocialNetwork::link()->get();
        $data = [
            'contacts' => [
                'social' => [
                    'links' => $social
                ]
            ]
        ];
        return view('main.termsOfUse', ['data' => $data]);
    }

    public function privacyPolicy()
    {
        $social = SocialNetwork::link()->get();
        $data = [
            'contacts' => [
                'social' => [
                    'links' => $social
                ]
            ]
        ];
        return view('main.privacyPolicy', ['data' => $data]);
    }
}
