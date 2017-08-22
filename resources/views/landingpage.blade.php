<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    @include('partial.head')
    @yield('css')
    <link rel="stylesheet" href="{{asset('css/landing.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>


<!-- Fixed navbar -->
<nav class="navbar navbar-default navbar-fixed-top">
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
                <li><a href="#home">Главная</a></li>
                <li><a href="#about">О проекте</a></li>
                <li><a href="#news">Новости</a></li>
                <li><a href="#questions">Вопрос-ответ</a></li>
                <li>
                    <a href="{{ url('/login') }}" class="main-menu__register-link">Войти/</a>
                    <a href="{{ url('/register') }}" class="main-menu__register-link">регистрация</a>
                </li>
                <li><a href="#regulations">Правила</a></li>
                <li><a href="#contacts">Контакты</a></li>
                <li>
                    @foreach($data['contacts']['social'] as $soc)
                        <a href="{{ $soc['link'] }}" class="main-menu__social-link"><img src="{{ asset($soc['img'].".svg") }}" alt="" class="main-menu__social-link__img"></a>
                    @endforeach
                </li>

            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<section id="home">
    <div class="container-fluid">
        <div class="row">
            <div class="owl-carousel main-carousel">
                @foreach($data['carousel'] as $carousel)
                <div class="carousel-item" style="background-image: url({{ $carousel['img'] }});">
                    <h3 class="carousel-caption">
                        {{ $carousel['caption'] }}
                    </h3>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<section id="about">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>О проекте</h1>
            </div>
        </div>
        <div class="row">
            @foreach($data['about'] as $about)
            <div class="col-xs-12 col-md-6 about__item">
                <div class="col-xs-4 about-icon__wrap">
                    <i class="{{ $about['icon'] }} fa-6 about-fa" aria-hidden="true"></i>
                </div>
                <div class="col-xs-8">
                    <h4>{{ $about['title'] }}</h4>
                    <div class="overflow about__overflow">
                        <p>{{ $about['description'] }}</p>
                    </div>
                    <a href="{{ $about['link'] }}" class="about__link">Подробнее...</a>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-xs-12 about__register-wrap">
                <a href="#" class="btn btn-success btn-lg">Регистрация</a>
            </div>
        </div>
    </div>
</section>
<section id="news" class="rate__wrap">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>Тарифы</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="owl-carousel rate-carousel">
                    @foreach($data['rate'] as $rate)
                        <div class="rate-carousel-item">
                            <h4>{{ $rate['title'] }}</h4>
                            <div class="overflow rate__overflow">
                                <p class="">
                                    {{ $rate['description'] }}
                                </p>
                            </div>
                            <a href="#" class="btn btn-success btn-md">Подписаться</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<section id="questions">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 text-center">
                @foreach($data['paysystems'] as $img)
                    <img src="{{ $img }}" alt="" class="paysystems__img">
                @endforeach
            </div>
        </div>
    </div>
</section>
<section id="login" class="news__wrap">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>Новости</h1>
            </div>
        </div>
        <div class="row">
            @foreach($data['news'] as $news)
            <div class="col-xs-12 col-md-4">
                <div class="news__item">
                    <h4>{{ $news['title'] }}</h4>
                    <div class="overflow news__overflow">
                        <p>{{ $news['description'] }}</p>
                    </div>
                    <a href="{{ $news['link'] }}" class="about__link">Читать далее...</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<section id="regulations">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>Контакты</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-md-7">
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <ul class="contacts__ul">
                            <li><h4>Телефоны:</h4></li>
                            @foreach($data['contacts']['phones'] as $phone)
                                <li>
                                    {{ $phone }}
                                </li>
                            @endforeach
                        </ul>
                        <ul class="contacts__ul">
                            <li><h4>Emails:</h4></li>
                            @foreach($data['contacts']['emails'] as $email)
                                <li>
                                    {{ $email }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <h4>Соц. сети:</h4>
                        @foreach($data['contacts']['social'] as $soc)
                            <a href="{{ $soc['link'] }}">
                                <img src="{{ asset($soc['img']."_black.svg") }}" alt="" class="contacts__img">
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-5">
                <form action="" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name">Имя</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Ваше имя">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="email@example.com">
                    </div>
                    <div class="form-group">
                        <label for="question">Вопрос</label>
                        <textarea name="question" id="question" class="form-control contacts__textarea"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Отправить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
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
        $(".main-carousel").owlCarousel({
            items : 1,
            autoplay: true,
            loop: true,
            dots: true,
        });
        $(".rate-carousel").owlCarousel({
            items : 3,
            autoplay: true,
            loop: true,
            dots: true,
            margin:10,
            responsiveClass:true,
            responsive:{
                0:{
                    items:1,
                    stagePadding: 50
                },
                600:{
                    items:3
                },
                1000:{
                    items:3
                }
            }
        });
        /*$("#menu").on("click","a", function (event) {
            event.preventDefault();
            var id  = $(this).attr('href'),
                top = $(id).offset().top - 50;
            $('body,html').animate({scrollTop: top}, 500);
        });*/
    });
</script>
</body>
</html>
