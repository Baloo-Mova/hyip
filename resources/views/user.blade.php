<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    @include('partial.head')
    @yield('css')
    <link rel="stylesheet" href="{{asset('css/user.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>


<!-- Fixed navbar -->
<nav class="navbar navbar-default navbar-static-top">
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
                <li><a href="#home">Главная</a></li>
                <li><a href="#about">О проекте</a></li>
                <li><a href="#news">Новости</a></li>
                <li><a href="#questions">Вопрос-ответ</a></li>
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
                <li><a href="#regulations">Правила</a></li>
                <li><a href="#contacts">Контакты</a></li>
                <li>
                    <a href="#" class="main-menu__social-link"><img src="{{ asset('img/vk.svg') }}" alt="" class="main-menu__social-link__img"></a>
                    <a href="#" class="main-menu__social-link"><img src="{{ asset('img/instagram.svg') }}" alt="" class="main-menu__social-link__img"></a>
                </li>

            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>


<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            @include('partial.usersidemenu')
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            @yield('content')
        </div>
    </div>
</div>

@include('partial.scripts')

<script>
    $(document).ready(function(){

    });
</script>
</body>
</html>
