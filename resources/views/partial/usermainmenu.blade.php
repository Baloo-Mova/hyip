<!-- Fixed navbar -->
<nav class="navbar navbar-default navbar-green navbar-static-top">
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
                        <a href="{{ $soc['link'] }}" class="main-menu__social-link"><img src="{{ asset($soc['img'].".svg") }}" alt="" class="main-menu__social-link__img"></a>
                    @endforeach
                </li>
            </ul>
            <ul class="nav navbar-nav hidden-md hidden-lg top_hidden_menu" id="menu">
                <li><a href="{{ route('index') }}">Главная</a></li>
                <li class="dropdown">
                    <a href="{{ route('about') }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">О компании <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Что такое White Coin?</a></li>
                        <li><a href="#">Как мы работаем?</a></li>
                        <li><a href="#">Наши цели</a></li>
                        <li><a href="#">Почему мы?</a></li>
                        <li><a href="#">Как зарабатывать?</a></li>
                        <li><a href="#">Документы</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('about') }}">Акции</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Партнерам <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Пополнить счет</a></li>
                        <li><a href="#">Вывести средства</a></li>
                        <li><a href="#">Тарифы</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('news') }}">Новости</a></li>
                <li><a href="{{ route('questions') }}">Вопрос-ответ</a></li>
                <li><a href="{{ route('contacts', ['#feedback']) }}">Обратная связь</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->login }} <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('cabinet') }}">Личный кабинет</a></li>
                        <li><a href="{{ route('logout') }}">Выйти</a></li>
                    </ul>
                </li>
                <li class="text-center pb20">
                    @foreach($data['contacts']['social']['links'] as $soc)
                        <a href="{{ $soc['link'] }}" class="main-menu__social-link"><img src="{{ asset($soc['img'].".svg") }}" alt="" class="main-menu__social-link__img"></a>
                    @endforeach
                </li>
            </ul>

        </div><!--/.nav-collapse -->
        <ul class="nav navbar-nav navbar-right top-main-menu__menu_right hidden-xs" >
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                   aria-haspopup="true" aria-expanded="false">
                    {!! Auth::user()->login !!} <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="{{ url('/logout') }}">Выйти</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
<nav class="navbar navbar-default navbar-static-top hidden-xs navbar__black  z100">
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
                        <li><a href="#">Что такое White Coin?</a></li>
                        <li><a href="#">Как мы работаем?</a></li>
                        <li><a href="#">Наши цели</a></li>
                        <li><a href="#">Почему мы?</a></li>
                        <li><a href="#">Как зарабатывать?</a></li>
                        <li><a href="#">Документы</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('about') }}">Акции</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Партнерам <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Пополнить счет</a></li>
                        <li><a href="#">Вывести средства</a></li>
                        <li><a href="#">Тарифы</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('news') }}">Новости</a></li>
                <li><a href="{{ route('questions') }}">Вопрос-ответ</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>