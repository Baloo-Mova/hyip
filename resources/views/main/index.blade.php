@extends('main')

@section('content')
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content btn-flat">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">@lang("messages.subscribe_tariff")</h4>
                </div>
                <div class="modal-body">
                    <h3 class="text-center modal_tariff_name "></h3>
                    <div class="col-xs-12 col-md-4 text-center">
                        <p class="tariff___ref-sys modal_tariff_levels">
                        </p>
                        <label>@lang('messages.ref_sys')</label>
                    </div>
                    <div class="col-xs-12 col-md-4 text-center">
                        <p class="tariff___price">
                            <span class="modal_tariff_price"></span>₽
                        </p>
                        <label>@lang('messages.price')</label>
                    </div>
                    <div class="col-xs-12 col-md-4 text-center">
                        <p class="tariff___term ">
                            <span class="modal_tariff_validity"></span>
                        </p>
                        <label>@lang('messages.validity')</label>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">@lang("messages.cansel")</button>
                    <a href="" class="btn btn-main-carousel btn-flat modal_tariff_subscribe">@lang("messages.subscribe")</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->

    <section id="home">
        <div class="container-fluid">
            <div id="" class="row ">
                <div class="owl-carousel main-carousel">
                    @foreach($data['carousel'] as $carousel)
                        <div class="carousel-item" style="background-image: url({{ route('get.image', ['type' => 'carousel', 'name' => $carousel['background_file']])  }} )">
                            <div class="carousel-caption">
                                <h3>
                                    {{ $carousel['text'] }}
                                </h3>
                                @if(isset($carousel['buttons']))
                                    @foreach(json_decode($carousel['buttons'], true) as $button)
                                        <a href="{{ url($button['url']) }}" class="btn btn-main-carousel btn-flat btn-carousel">{{ $button['text'] }}</a>
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
                            <h1 class="greetings_title">{{ $data['greetings']['main_title'] }}</h1>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="greetings_img_wrap">
                                <img src="{{ route('get.image', ['type' => 'greetings', 'name' => $data['greetings']['image']]) }}" alt="" class="greetings_img">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <h4 class="greetings_subtitle">{{ $data['greetings']['sub_title'] }}</h4>
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
                    <h1>@lang('messages.about_project')</h1>
                </div>
            </div>
            @foreach($data['about'] as $key=>$about)
                @if($key == 0 || $key % 2 == 0)
                    <div class="row">
                        <div class="col-xs-12 col-md-4">
                            <div class="about__img">
                                <img src="{{ route('get.image', ['type' => 'aboutproject', 'name' => $about['image']]) }}" alt="">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-8">
                            <h4>{{ $about['title'] }}</h4>
                            <p>{{ $about['description'] }}</p>
                            {{--<a href="{{ $about['link'] }}" class="about__link">Подробнее...</a>--}}
                        </div>
                    </div>
                    @if($about != end($data['about']))
                        <hr>
                    @endif
                @else
                    <div class="row">
                        <div class="col-xs-12 col-md-4 col-md-push-8">
                            <div class="about__img">
                                <img src="{{ route('get.image', ['type' => 'aboutproject', 'name' => $about['image']]) }}" alt="">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-8 col-md-pull-4">
                            <h4>{{ $about['title'] }}</h4>
                            <p>{{ $about['description'] }}</p>
                            {{--<a href="{{ $about['link'] }}" class="about__link">Подробнее...</a>--}}
                        </div>
                    </div>
                    @if($about != end($data['about']))
                        <hr>
                    @endif
                @endif
            @endforeach
            <div class="row">
                <div class="col-xs-12 about__register-wrap">
                    <a href="{{ route('register') }}" class="btn btn-main-carousel btn-lg btn-flat">@lang('messages.register')</a>
                </div>
            </div>
        </div>
    </section>

    <section id="steps" class="steps">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h1>{{ isset($data['threesteps']) ? $data['threesteps']->main_title : "3 шага, чтобы начать зарабатывать" }}</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 l-steps">
                    <div class="row">
                        <div class="col-md-4 cut">
                            <div class="l-steps__item">
                                @if(isset($data['threesteps']->first_img))
                                <div class="l-steps__item-img text-center">
                                    <img src="{{ route('get.image', ['type' => 'three_steps', 'name' => $data['threesteps']->first_img]) }}" alt="">
                                </div>
                                @endif
                                <div class="l-steps__item-number text-center">
                                    <span class="kostil_1"> 1.</span>
                                </div>
                                <div class="l-steps__item-about">
                                    {!! isset($data['threesteps']) ? $data['threesteps']->first_title : "" !!}
                                </div>
                                <div class="l-steps__item-description">
                                    {!! isset($data['threesteps']) ? $data['threesteps']->first_text : "" !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 cut big_p">
                            <div class="l-steps__item">
                                @if(isset($data['threesteps']->second_img))
                                <div class="l-steps__item-img text-center">
                                    <img src="{{ route('get.image', ['type' => 'three_steps', 'name' => $data['threesteps']->second_img]) }}" alt="">
                                </div>
                                @endif
                                <div class="l-steps__item-number text-center">
                                    <span> 2.</span>
                                </div>
                                <div class="l-steps__item-about">
                                    {!! isset($data['threesteps']) ? $data['threesteps']->second_title : "" !!}
                                </div>
                                <div class="l-steps__item-description">
                                    {!! isset($data['threesteps']) ? $data['threesteps']->second_text : "" !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 cut">
                            <div class="l-steps__item">
                                @if(isset($data['threesteps']->third_img))
                                <div class="l-steps__item-img text-center">
                                    <img src="{{ route('get.image', ['type' => 'three_steps', 'name' => $data['threesteps']->third_img]) }}" alt="">
                                </div>
                                @endif
                                <div class="l-steps__item-number text-center">
                                    <span> 3.</span>
                                </div>
                                <div class="l-steps__item-about">
                                    {!! isset($data['threesteps']) ? $data['threesteps']->third_title : "" !!}
                                </div>
                                <div class="l-steps__item-description">
                                    {!! isset($data['threesteps']) ? $data['threesteps']->third_text : "" !!}
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
                    <h1>@lang('messages.tariffs')</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="owl-carousel rate-carousel">
                        @foreach($data['rate'] as $rate)
                            <div class="rate-carousel-item">
                                <div class="rate__img">
                                    <img src="{{ route('get.image', ['type' => 'tariff', 'name' => $rate['image']]) }}" class="" alt="">
                                </div>
                                <div class="rate__title">
                                    <h3>{{ $rate['name'] }}</h3>
                                </div>
                                <div class="rate__body">
                                    <p class="rate__price">@lang('messages.price'): {{ $rate['price'] }}₽</p>
                                    <p class="reate__price_p">@lang('messages.ref_sys'): {{ $rate['levels']." ".pluralForm($rate['levels'], __("messages.levels_1"), __("messages.levels_2"), __("messages.levels_5")) }}</p>
                                    <hr>
                                    @if(isset($rate['first_prices']))
                                        @for($i = 0; $i < 3; $i++)
                                            @if(!isset($rate['first_prices'][$i]))
                                                <p>-</p>
                                                <hr>
                                                @continue
                                            @else
                                                <p>{{ ($rate['first_prices'][$i]['level'] + 1)." ".__("messages.level") }} {{ $rate['first_prices'][$i]['is_percent'] ? $rate['first_prices'][$i]['value']."%" : $rate['first_prices'][$i]['value']."₽" }}</p>
                                                <hr>
                                            @endif
                                        @endfor
                                    @endif
                                    <p>@lang('messages.validity'): {{ $rate['term']." ".pluralForm($rate['term'], __("messages.days_1"), __("messages.days_2"), __("messages.days_5")) }} </p>
                                </div>
                                <div class="rate__footer">
                                    @if(isset($data['user']->subscribe_id) && $data['user']->subscribe_id == $rate['id'] )
                                        <a class="btn btn-primary btn-md btn-flat rate-carousel__button">@lang('messages.subscribed')</a>
                                    @else
                                        <a href=""
                                           class="btn btn-main-carousel btn-md btn-flat rate-carousel__button subscribe__button"
                                           data-toggle="modal"
                                           data-target="#myModal"
                                           data-price="{{ $rate['price'] }}"
                                           data-name="{{ $rate['name'] }}"
                                           data-levels="{{ $rate['levels'] }}"
                                           data-validity="{{ $rate['term'] }}"
                                           data-id="{{ $rate['id'] }}"
                                        >@lang('messages.subscribe')</a>
                                    @endif
                                        <a href="{{ Auth::check() ? route('tariff', ['id' => $rate['id']]) : route('about.tariffs', ['id' => $rate['id']]) }}" class="btn btn-main-carousel btn-md btn-flat rate-carousel__button">@lang('messages.more')</a>
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
                    <h1>@lang('messages.news')</h1>
                </div>
            </div>
            <div class="row text-center">
                @foreach($data['news'] as $news)
                    <div class="col-xs-12 col-md-4 text-center news__item--new">
                        <div class="news__item">
                            <h4>{{ $news['title'] }}</h4>
                            <div class="overflow news__overflow">
                                <p>{!!  $news['content'] !!}</p>
                            </div>
                            <a href="{{ route('news') }}" class="about__link">@lang('messages.more')</a>
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
                    <h1>@lang('messages.contacts')</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-7">
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <ul class="contacts__ul">
                                <li><h4>Emails:</h4></li>
                                @foreach($data['contacts']['emails'] as $email)
                                    <li>
                                        {{ $email->value }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <h4>@lang('messages.share'):</h4>
                            @foreach($data['contacts']['social']['share'] as $soc)
                                @if($soc->need_show == 0)
                                    @continue
                                @endif
                                <a href="{{ $soc->link }}" class="no_underline" target="_blank">
                                    <i class="{{ $soc->icon." ".$soc->color }} contacts_ico"></i>
                                </a>
                            @endforeach
                            <h4>@lang('messages.we_in_social_networks'):</h4>
                            @foreach($data['contacts']['social']['links'] as $soc)
                                @if($soc->is_active == 0)
                                    @continue
                                @endif
                                <a href="{{ $soc->link }}" class="no_underline" target="_blank">
                                    <i class="{{ $soc->icon}} contacts_ico"></i>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-5">
                    <form action="{{ route('create-feedback') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group @if( is_error('name') )has-error @endif">
                            <label for="name">@lang('messages.name')</label>
                            <input type="text" class="form-control btn-flat" name="name" id="name" placeholder="@lang('messages.your_name')">
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
                            <label for="question">@lang('messages.question')</label>
                            <textarea name="question" id="question" class="form-control contacts__textarea btn-flat"></textarea>
                            @if( is_error('question') )
                                <span class="help-block">{{ $errors->first('question') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-main-carousel btn-flat">@lang('messages.send')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <?php
    function pluralForm($n, $form1, $form2, $form5)
    {
        $n = abs($n) % 100;
        $n1 = $n % 10;
        if ($n > 10 && $n < 20) return $form5;
        if ($n1 > 1 && $n1 < 5) return $form2;
        if ($n1 == 1) return $form1;
        return $form5;
    }
    ?>

@endsection

@section('js')
    <script>
        $(document).ready(function () {

            $(".subscribe__button").on("click", function(){
                var price = $(this).data("price"),
                    name = $(this).data("name"),
                    levels = $(this).data("levels"),
                    validity = $(this).data("validity"),
                    id = $(this).data("id");

                var lev = "";

                if(levels == 1){
                    lev = "{{ __('messages.level_1') }}";
                }else{
                    if(levels > 1 && levels < 5){
                        lev = "{{ __('messages.level_2-4') }}";
                    }else{
                        lev = "{{ __('messages.level_5') }}";
                    }
                }

                $(".modal_tariff_name").text(name);
                $(".modal_tariff_price").text(price);
                $(".modal_tariff_levels").text(levels+" "+getNumEnding(levels, ['{{ __("messages.levels_1") }}', '{{ __("messages.levels_2") }}', '{{ __("messages.levels_5") }}']));
                $(".modal_tariff_validity").text(validity+" "+getNumEnding(validity, ['{{ __("messages.days_1") }}', '{{ __("messages.days_2") }}', '{{ __("messages.days_5") }}']));
                $(".modal_tariff_subscribe").prop("href", "{{ url('/cabinet/tariff/buy') }}"+"/"+id);
            });

            function getNumEnding(iNumber, aEndings)
            {
                var sEnding, i;
                iNumber = iNumber % 100;
                if (iNumber>=11 && iNumber<=19) {
                    sEnding=aEndings[2];
                }
                else {
                    i = iNumber % 10;
                    switch (i)
                    {
                        case (1): sEnding = aEndings[0]; break;
                        case (2):
                        case (3):
                        case (4): sEnding = aEndings[1]; break;
                        default: sEnding = aEndings[2];
                    }
                }
                return sEnding;
            }

            var is_three = false;
            $(".main-carousel").owlCarousel({
                items: 1,
                autoplay: true,
                loop: true,
                dots: true,
            });
            var rateCarousel = $(".rate-carousel");
            rateCarousel.owlCarousel({
                autoplay: false,
                loop: false,
                dots: true,
                margin: 10,
                center: false,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 3
                    },
                    1000: {
                        items: 3
                    }
                },
                onInitialized: function(e) {
                    if(this.items().length > 3){
                        is_three = true;
                    }
                }
            });

            var left_position = 0;

            if(is_three){
                $(".rate-carousel").on('mouseenter', function () {
                    left_position = $(".rate-carousel .owl-stage").position().left;
                    if(left_position <= 0 && left_position > -50){
                        left_position = left_position - 50;
                        $(".rate-carousel .owl-stage").css({"transform": "translate3d("+(left_position)+"px, 0px, 0px)", "transition": "transform 1s linear"});
                    }
                });
                $(".rate-carousel").on('mouseleave', function () {
                    left_position = $(".rate-carousel .owl-stage").position().left;
                    if(left_position == -50){
                        $(".rate-carousel .owl-stage").css({"transform": "translate3d(0px, 0px, 0px)", "transition": "transform 1s linear"});
                    }});
            }

            $(".anchor_a").on("click", function (event) {
                event.preventDefault();
                var id  = $(this).attr('href'),
                    top = $(id).offset().top - 50;
                $('body,html').animate({scrollTop: top}, 500);
            });
        });
    </script>
@stop

