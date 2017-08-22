<div class="container-fliud">
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
            <li><a href="{{ route('about') }}">О проекте</a></li>
            <li><a href="{{ route('news') }}">Новости</a></li>
            <li><a href="{{ route('questions') }}">Вопрос-ответ</a></li>
            @if (Auth::check())
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                       aria-haspopup="true" aria-expanded="false">
                        {!! Auth::user()->login !!} <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('/logout') }}">Выйти</a></li>
                    </ul>
                </li>
            @else
                <li>
                    <a href="{{ url('/login') }}" class="main-menu__register-link">Войти/</a>
                    <a href="{{ url('/register') }}" class="main-menu__register-link">регистрация</a>
                </li>
            @endif
            <li><a href="{{ route('regulations') }}">Правила</a></li>
            <li><a href="{{ route('contacts') }}">Контакты</a></li>
            <li>
                @foreach($data['contacts']['social'] as $soc)
                    <a href="{{ $soc['link'] }}" class="main-menu__social-link"><img src="{{ asset($soc['img'].".svg") }}" alt="" class="main-menu__social-link__img"></a>
                @endforeach
            </li>

        </ul>
    </div><!--/.nav-collapse -->
</div>