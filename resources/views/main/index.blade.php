@extends('main')

@section('content')
    <section id="home">
        <div class="container-fluid">
            <div id="" class="row ">
                <div class="owl-carousel main-carousel">
                    @foreach($data['carousel'] as $carousel)
                        <div class="carousel-item" style="background-image: url({{ $carousel['img'] }})">
                            <div class="carousel-caption">
                                <h3>
                                    {{ $carousel['caption'] }}
                                </h3>
                                @if(isset($carousel['buttons']))
                                    @foreach($carousel['buttons'] as $button)
                                        <a href="{{ $button['link'] }}" class="btn {{ $button['class'] }} btn-carousel">{{ $button['title'] }}</a>
                                    @endforeach
                                @endif
                            </div>

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
            @foreach($data['about'] as $key=>$about)
                @if($key == 0 || $key % 2 == 0)
                    <div class="row">
                        <div class="col-xs-12 col-md-4">
                            <div class="about__img">
                                <img src="{{ $about['img'] }}" alt="">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-8">
                            <h4>{{ $about['title'] }}</h4>
                            <p>{{ $about['description'] }}</p>
                            <a href="{{ $about['link'] }}" class="about__link">Подробнее...</a>
                        </div>
                    </div>
                    @if($about != end($data['about']))
                        <hr>
                    @endif
                @else
                    <div class="row">
                        <div class="col-xs-12 col-md-4 col-md-push-8">
                            <div class="about__img">
                                <img src="{{ $about['img'] }}" alt="">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-8 col-md-pull-4">
                            <h4>{{ $about['title'] }}</h4>
                            <p>{{ $about['description'] }}</p>
                            <a href="{{ $about['link'] }}" class="about__link">Подробнее...</a>
                        </div>
                    </div>
                    @if($about != end($data['about']))
                        <hr>
                    @endif
                @endif
            @endforeach
            <div class="row">
                <div class="col-xs-12 about__register-wrap">
                    <a href="{{ url('register') }}" class="btn btn-main-carousel btn-lg btn-flat">Регистрация</a>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 main_page_divider">
                    &nbsp;
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
            <div class="row">
                <div class="col-xs-12 main_page_divider main_page_divider_second">
                    &nbsp;
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
                                <div class="rate__top">
                                    &nbsp;
                                </div>
                                <div class="rate__img">
                                    <img src="img/{{ random_int(1,3) }}.jpg" class="" alt="">
                                </div>
                                <div class="rate__title">
                                    <h3>{{ $rate['name'] }}</h3>
                                </div>
                                <div class="rate__body">
                                    <p class="rate__price">Цена: {{ $rate['price'] }}</p>
                                    <p>Реферальная система: {{ $rate['levels'] }} уровня</p>
                                    <hr>
                                    @if(isset($rate['first_prices']))
                                        @for($i = 0; $i < 3; $i++)
                                            @if(!isset($rate['first_prices'][$i]))
                                                -
                                                <hr>
                                                @continue
                                            @else
                                                <p>{{ ($rate['first_prices'][$i]['level'] + 1)." уровень -" }} {{ $rate['first_prices'][$i]['is_percent'] ? $rate['first_prices'][$i]['value']."%" : $rate['first_prices'][$i]['value'] }}</p>
                                                <hr>
                                            @endif
                                        @endfor
                                    @endif
                                    <p>Срок действия: {{ $rate['term'] }} дней</p>
                                </div>
                                <div class="rate__footer">
                                    <a href="{{ url('register') }}" class="btn btn-main-carousel btn-md btn-flat rate-carousel__button">Оформить подписку</a>
                                    <a href="{{ route('about.tariffs') }}" class="btn btn-main-carousel btn-md btn-flat rate-carousel__button">Подробнее</a>
                                </div>
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
                                    <i class="{{ $soc['ico'] }} contacts_ico"></i>
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
                            <input type="text" class="form-control btn-flat" name="name" id="name" placeholder="Ваше имя">
                            @if( is_error('name') )
                                <span class="help-block">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="form-group @if( is_error('email') )has-error @endif">
                            <label for="email">Email</label>
                            <input type="email" class="form-control btn-flat" name="email" id="email"
                                   placeholder="email@example.com">
                            @if( is_error('email') )
                                <span class="help-block">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group @if( is_error('question') )has-error @endif">
                            <label for="question">Вопрос</label>
                            <textarea name="question" id="question" class="form-control contacts__textarea btn-flat"></textarea>
                            @if( is_error('question') )
                                <span class="help-block">{{ $errors->first('question') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-main-carousel btn-flat">Отправить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $(".main-carousel").owlCarousel({
                items: 1,
                autoplay: true,
                loop: true,
                dots: true,
            });
            var rateCarousel = $(".rate-carousel");
            rateCarousel.owlCarousel({
                autoplay: true,
                loop: true,
                dots: true,
                margin: 10,
                center: true,
                responsiveClass: true,
                autoplayTimeout:1500,
                autoplayHoverPause:false,
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
            rateCarousel.trigger('stop.owl.autoplay');
            $(".rate-carousel").on('mouseenter', function () {
                rateCarousel.trigger('play.owl.autoplay', [1500]);
            });
            $(".rate-carousel").on('mouseleave', function () {
                rateCarousel.trigger('stop.owl.autoplay');
            });
            $(".anchor_a").on("click", function (event) {
                event.preventDefault();
                var id  = $(this).attr('href'),
                    top = $(id).offset().top - 50;
                $('body,html').animate({scrollTop: top}, 500);
            });
        });
    </script>
@stop

