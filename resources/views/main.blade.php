<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    @include('partial.head')
    @yield('css')
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
</head>
<body>


<!-- Fixed navbar -->
<nav class="navbar navbar-green navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">
                <img alt="Brand" src="{{ asset('img/logo.png') }}">
            </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse top-main-menu__wrap">
            <ul class="nav navbar-nav top-main-menu__menu_left new_nav" id="menu">
                <li>
                    @foreach($data['contacts']['social']['links'] as $soc)
                        <a href="{{ $soc['link'] }}" class="main-menu__social-link"><img src="{{ asset($soc['img'].".svg") }}" alt="" class="main-menu__social-link__img"></a>
                    @endforeach
                </li>
            </ul>

        </div><!--/.nav-collapse -->
        <ul class="nav navbar-nav navbar-right top-main-menu__menu_right hidden-sm hidden-xs" >
            <li><a href="#regulations" class="anchor_a">Feedback</a></li>
            <li><a href="{{ url('/login') }}">Login</a></li>
            <li><a href="{{ url('/register') }}">Registration</a></li>
        </ul>
    </div>
</nav>
<nav class="navbar navbar-default navbar-static-top">
    @include('partial.mainmenu')
</nav>

@yield('content')


<footer>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <p>Все права защищены. 2017</p>
            </div>
        </div>
    </div>
</footer>

@include('partial.scripts')

<script>
    $(document).ready(function(){

    });
</script>
</body>
</html>
