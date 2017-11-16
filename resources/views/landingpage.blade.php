<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{env('APP_NAME')}}</title>
    @include("partial.meta_tags")
    @include('partial.head')
    @yield('css')
    <link rel="stylesheet" href="{{asset('css/landing.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
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

<section id="home">
    <div class="container-fluid">
        <div id="video_container" class="row video_container">
            <video id="video" width="" height="" autoplay="autoplay" loop="loop" preload="auto">
                <source src="{{ asset('mov/628513837.mp4') }}"></source>
            </video>
            <div class="video_container_after"></div>
            <div class="owl-carousel main-carousel">
                @foreach($data['carousel'] as $carousel)
                    <div class="carousel-item">
                        <h3 class="carousel-caption">
                            {{ $carousel['caption'] }}
                        </h3>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<section id="greetings" class="greetings">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="greetings__wrap row">
                    <div class="col-xs-12">
                        <h1 class="greetings_title">WELCOME TO {{ env("APP_NAME") }}</h1>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <div class="greetings_img_wrap">
                            <img src="{{ $data['greetings']['img'] }}" alt="" class="greetings_img">
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <h4 class="greetings_subtitle">Trust Management</h4>
                        <p class="greetings_txt">
                            {{ $data['greetings']['description'] }}
                        </p>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="about" class="about">
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
                        <a href="{{ route('about') }}" class="about__link">Подробнее...</a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-xs-12 about__register-wrap">
                <a href="{{ url('register') }}" class="btn btn-success btn-lg">Регистрация</a>
            </div>
        </div>
    </div>
</section>

<section id="steps" class="steps">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>3 шага, чтобы начать зарабатывать</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 l-steps">
                <div class="row">
                    <div class="col-md-4 cut">
                        <div class="l-steps__item">
                            <div class="l-steps__item-number">
                                <span class="kostil_1">1.</span>
                            </div>
                            <div class="l-steps__item-about">
                                <a href="#" class="about__link">
                                    <span class="js-translate">Register an account</span>
                                </a>
                                <span class="js-translate">&nbsp;and choose an investment portfolio</span>
                            </div>
                            <div class="l-steps__item-description">
                                <span class="js-translate">On our website, you can find a convenient registration form consisting of several simple fields. Just in case, we use special technologies to correct any of your registration mistakes, even intentional.</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 cut big_p">
                        <div class="l-steps__item">
                            <div class="l-steps__item-number">
                                <span>2.</span>
                            </div>
                            <div class="l-steps__item-about">
                                <span class="js-translate">Choose an investment portfolio that fits your needs</span>
                            </div>
                            <div class="l-steps__item-description">
                                <span class="js-translate">Once in the back office, review the list of investment portfolios and choose one <br>to invest in.</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 cut">
                        <div class="l-steps__item">
                            <div class="l-steps__item-number">
                                <span>3.</span>
                            </div>
                            <div class="l-steps__item-about">
                                <span class="js-translate">Fund the account in a convenient way and buy a portfolio</span>
                            </div>
                            <div class="l-steps__item-description">
                                <span class="js-translate">You can easily make a deposit to your account via bank transfer or electronic payment systems.</span>
                            </div>
                        </div>
                    </div>
                </div>
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
                            <a href="{{ route('tariff.payment',['id'=>$tariff['id']]) }}" class="btn btn-success btn-md">Подписаться</a>
                        </div>
                    @endforeach
                </div>
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
                        <a href="{{ route('news') }}" class="about__link">Читать далее...</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<section id="questions" class="questions">
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
<section id="regulations" class="regulations">
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
                        <h4>Поделиться:</h4>
                        @foreach($data['contacts']['social']['share'] as $soc)
                            <a href="{{ $soc['link'] }}">
                                <img src="{{ asset($soc['img']."_black.svg") }}" alt="" class="contacts__img">
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-5">
                <form action="{{ route('create-feedback') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group @if( is_error('name') )has-error @endif">
                        <label for="name">Имя</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Ваше имя">
                        @if( is_error('name') )
                            <span class="help-block">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="form-group @if( is_error('email') )has-error @endif">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email"
                               placeholder="email@example.com">
                        @if( is_error('email') )
                            <span class="help-block">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="form-group @if( is_error('question') )has-error @endif">
                        <label for="question">Вопрос</label>
                        <textarea name="question" id="question" class="form-control contacts__textarea"></textarea>
                        @if( is_error('question') )
                            <span class="help-block">{{ $errors->first('question') }}</span>
                        @endif
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
    $(document).ready(function () {
        $(".main-carousel").owlCarousel({
            items: 1,
            autoplay: true,
            loop: true,
            dots: true,
        });
        $(".rate-carousel").owlCarousel({
            items: 3,
            autoplay: true,
            loop: true,
            dots: true,
            margin: 10,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                    stagePadding: 50
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 3
                }
            }
        });
        $(".anchor_a").on("click", function (event) {
         event.preventDefault();
         var id  = $(this).attr('href'),
         top = $(id).offset().top - 50;
         $('body,html').animate({scrollTop: top}, 500);
         });
    });
</script>

</body>
</html>
