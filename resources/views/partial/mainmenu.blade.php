<!-- Fixed navbar -->
<nav class="navbar navbar-default navbar-green navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ route('index') }}">
                <img alt="Brand" src="{{ asset('img/logo.png') }}">
            </a>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div id="navbar" class="navbar-collapse collapse top-main-menu__wrap ">
            <ul class="nav navbar-nav top-main-menu__menu_left new_nav hidden-sm hidden-xs" id="menu">
                <li>
                    @foreach($data['contacts']['social']['links'] as $soc)
                        <a href="{{ $soc->link }}" class="main-menu__social-link">
                            <i class="{{ $soc->icon }} main-menu__social-link__icon"></i>
                        </a>
                    @endforeach
                </li>
            </ul>
            <ul class="nav navbar-nav hidden-md hidden-lg top_hidden_menu" id="menu">
                <li><a href="{{ route('index') }}">Главная</a></li>
                <li class="dropdown">
                    <a href="{{ route('about') }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">О компании <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('about', ['#what']) }}" data-anchor="what" class="about_menu_a">Что такое White Coin?</a></li>
                        <li><a href="{{ route('about', ['#how_we_work']) }}" data-anchor="how_we_work" class="about_menu_a">Как мы работаем?</a></li>
                        <li><a href="{{ route('about', ['#our_targets']) }}" data-anchor="our_targets" class="about_menu_a">Наши цели</a></li>
                        <li><a href="{{ route('about', ['#why_we']) }}" data-anchor="why_we" class="about_menu_a">Почему мы?</a></li>
                        <li><a href="{{ route('about', ['#how_earn']) }}" data-anchor="how_earn" class="about_menu_a">Как зарабатывать?</a></li>
                        <li><a href="{{ route('about', ['#documents']) }}" data-anchor="documents" class="about_menu_a">Документы</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('stock') }}">Акции</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Партнерам <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ Auth::check() ? route('facilities', ['type' => 'input']) : route('input.output', ['type' => 'input']) }}">Пополнить счет</a></li>
                        <li><a href="{{ Auth::check() ? route('facilities', ['type' => 'output']) : route('input.output', ['type' => 'output']) }}">Вывести средства</a></li>
                        <li><a href="{{ Auth::check() ? route('tariff', ['id' => -1]) : route('about.tariffs', ['id' => -1]) }}">Тарифы</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('news') }}">Новости</a></li>
                <li><a href="{{ route('questions') }}">Вопрос-ответ</a></li>
                <li><a href="{{ route('contacts', ['#feedback']) }}">Обратная связь</a></li>
                @if(Auth::check())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->login }} <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('cabinet') }}">Личный кабинет</a></li>
                            <li><a href="{{ route('logout') }}">Выйти</a></li>
                        </ul>
                    </li>
                @else
                    <li><a href="{{ route('register') }}">Регистрация</a></li>
                    <li><a href="{{ route('login') }}">Войти</a></li>
                @endif
                <li class="text-center pb20">
                    @foreach($data['contacts']['social']['links'] as $soc)
                        <a href="{{ $soc['link'] }}" class="main-menu__social-link"><img src="{{ asset($soc['img'].".svg") }}" alt="" class="main-menu__social-link__img"></a>
                    @endforeach
                </li>
            </ul>

        </div><!--/.nav-collapse -->
        <ul class="nav navbar-nav navbar-right top-main-menu__menu_right hidden-xs" >
            <li><a href="{{ route('contacts', ['#feedback']) }}">Обратная связь</a></li>
            @if(Auth::check())
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->login }} <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li class="bottom-border"><a href="{{ route('cabinet') }}">Личный кабинет</a></li>
                        <li class="no-top-border"><a href="{{ route('logout') }}">Выйти</a></li>
                    </ul>
                </li>
            @else
                <li><a href="{{ route('register') }}">Регистрация</a></li>
                <li><a href="{{ route('login') }}">Войти</a></li>
            @endif
        </ul>
    </div>
</nav>
<nav class="navbar navbar-default navbar-fixed-top hidden-xs navbar__black navbar-fixed-top--new">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div id="navbar" class="navbar-collapse collapse main-menu__wrap">
            <ul class="nav navbar-nav main-menu__menu_center" id="menu">
                <li><a href="{{ route('index') }}">Главная</a></li>
                <li class="dropdown">
                    <a href="{{ route('about') }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">О компании <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('about', ['#what']) }}" data-anchor="what" class="about_menu_a">Что такое White Coin?</a></li>
                        <li><a href="{{ route('about', ['#how_we_work']) }}" data-anchor="how_we_work" class="about_menu_a">Как мы работаем?</a></li>
                        <li><a href="{{ route('about', ['#our_targets']) }}" data-anchor="our_targets" class="about_menu_a">Наши цели</a></li>
                        <li><a href="{{ route('about', ['#why_we']) }}" data-anchor="why_we" class="about_menu_a">Почему мы?</a></li>
                        <li><a href="{{ route('about', ['#how_earn']) }}" data-anchor="how_earn" class="about_menu_a">Как зарабатывать?</a></li>
                        <li><a href="{{ route('about', ['#documents']) }}" data-anchor="documents" class="about_menu_a">Документы</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('stock') }}">Акции</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Партнерам <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ Auth::check() ? route('facilities', ['type' => 'input']) : route('input.output', ['type' => 'input']) }}">Пополнить счет</a></li>
                        <li><a href="{{ Auth::check() ? route('facilities', ['type' => 'output']) : route('input.output', ['type' => 'output']) }}">Вывести средства</a></li>
                        <li><a href="{{ Auth::check() ? route('tariff', ['id' => -1]) : route('about.tariffs', ['id' => -1]) }}">Тарифы</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('news') }}">Новости</a></li>
                <li><a href="{{ route('questions') }}">Вопрос-ответ</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>