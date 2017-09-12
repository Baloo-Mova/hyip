@extends('main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>Тарифы</h1>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="owl-carousel rate-carousel">
                    @foreach($tariffs as $tariff)
                        <div class="rate-carousel-item rate-carousel-item--info-page tariff_{{ $tariff['id'] }} {{ !empty($tariff_info) && $tariff_info->id == $tariff['id']  ? "active_tariff" : "" }}">
                            <div class="rate__img">
                                <img src="{{ asset('img/'.random_int(1,3).'.jpg') }}" class="" alt="">
                            </div>
                            <div class="rate__title">
                                <h3>{{ $tariff['name'] }}</h3>
                            </div>
                            <div class="rate__body">
                                <p class="rate__price">Цена: {{ $tariff['price'] }}</p>
                                <p>Реферальная система: {{ $tariff['levels'] }} {{ $tariff['levels'] == 1 ? "уровень" : ($tariff['levels'] > 1 && $tariff['levels'] < 5 ? "уровня" : "уровней" ) }}</p>
                                <hr>
                                @if(isset($tariff->firstPrices))
                                    @for($i = 0; $i < 3; $i++)
                                        @if(!isset($tariff->firstPrices[$i]))
                                            -
                                            <hr>
                                            @continue
                                        @else
                                            <p>{{ ($tariff->firstPrices[$i]['level'] + 1)." уровень -" }} {{ $tariff->firstPrices[$i]['is_percent'] ? $tariff->firstPrices[$i]['value']."%" : $tariff->firstPrices[$i]['value'] }}</p>
                                            <hr>
                                        @endif
                                    @endfor
                                @endif
                                <p>Срок действия: {{ $tariff['term'] }} дней</p>
                            </div>
                            <div class="rate__footer">
                                <a href="{{ url('register') }}" class="btn btn-main-carousel btn-md btn-flat rate-carousel__button">Оформить подписку</a>
                                <a href="#" class="btn btn-main-carousel btn-md btn-flat rate-carousel__button tariff__choose" data-id="{{ $tariff['id'] }}">Подробнее</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row about-tariff__wrap {{ empty($tariff_info) ? "hidden" : "" }}">
            <div class="col-xs-12">
                <div class="news__item about-tariff__item">
                    <h3 class="tariff___name">{{ isset($tariff_info->name) ? $tariff_info->name : "" }}</h3>
                    <div class="col-xs-12 col-md-4">
                        <p class="tariff___ref-sys">{{ isset($tariff_info->levels) ? $tariff_info->levels : "" }}</p>
                        <h4>Реферальная система</h4>
                    </div>
                    <div class="col-xs-12 col-md-4">
                        <p class="tariff___price">{{ isset($tariff_info->price) ? $tariff_info->price : "" }}</p>
                        <h4>Цена</h4>
                    </div>
                    <div class="col-xs-12 col-md-4">
                        <p class="tariff___term">{{ isset($tariff_info->term) ? $tariff_info->term : "" }}</p>
                        <h4>Срок действия</h4>
                    </div>
                    <div class="col-xs-12">
                        <div class="owl-carousel info-carousel">
                            @if(isset($tariff_info->firstPrices))
                                @foreach($tariff_info->firstPrices as $prices)
                                    <div class="rate-carousel-item">
                                        <p class="tariff___price">{{$prices->value }}{{ $prices->is_percent ? "%" : "" }}</p>
                                        <h4>{{ ($prices->level + 1)." уровень"}}</h4>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="tariff___description">
                            <p>{{ isset($tariff_info->description) ? $tariff_info->description : "" }}</p>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function () {
            var is_three = false,
                rateCarousel = $(".rate-carousel"),
                infoCarousel = $(".info-carousel");

            infoCarousel.owlCarousel({
                autoplay: true,
                loop: false,
                dots: true,
                margin: 10,
                center: false,
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

            $(".tariff__choose").on("click", function(e){
                var scrollPosition = $(window).scrollTop();
                e.preventDefault();
                var id = $(this).data("id");
                $(".about-tariff__wrap").removeClass("hidden");
                $(".rate-carousel-item").removeClass("active_tariff");
                $('#preloader').fadeIn('slow',function(){$(this).show();});
                $.ajax({
                    method  : "get",
                    url     : "{{ url('get-tariff-info') }}/" + id,
                    success : function (data) {
                        if (data.success == true) {
                            $('#preloader').fadeOut('slow',function(){$(this).hide();});
                            $(".tariff_"+id).addClass("active_tariff");
                            $(".tariff___ref-sys").text(data.info.levels);
                            $(".tariff___name").text(data.info.name);
                            $(".tariff___price").text(data.info.price);
                            $(".tariff___term").text(data.info.term);
                            $(".tariff___description").text(data.info.description == null ? "У этого тарифа нет описания" : data.info.description);

                            var prices = ''
                                tmp = "";
                            data.prices.forEach(function (item, i, arr) {
                                tmp = data.prices[i].is_percent ? "%" : "";
                                prices += '<div class="rate-carousel-item"><p class="tariff___price">'+data.prices[i].value +' '+tmp+'</p>'+
                                    '<h4>'+(data.prices[i].level + 1)+' уровень</h4></div>';

                            });
                            $(".info-carousel").html(prices);

                            infoCarousel.trigger('destroy.owl.carousel');
                            infoCarousel.html(infoCarousel.find('.owl-stage-outer').html()).removeClass('owl-loaded');
                            infoCarousel.owlCarousel({
                                autoplay: true,
                                loop: false,
                                dots: true,
                                margin: 10,
                                center: false,
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
                            if(scrollPosition < 343){
                                $('html, body').animate({
                                    scrollTop: $(document).height()
                                }, 1000);
                            }
                        }
                    },
                    dataType: "json"
                });
            });

            rateCarousel.owlCarousel({
                autoplay: false,
                loop: false,
                dots: true,
                margin: 10,
                center: false,
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
                    if(left_position == 0){
                        left_position = left_position - 100;
                        $(".rate-carousel .owl-stage").css({"transform": "translate3d("+(left_position)+"px, 0px, 0px)", "transition": "transform .1s linear"});
                    }
                });
                $(".rate-carousel").on('mouseleave', function () {
                    left_position = $(".rate-carousel .owl-stage").position().left;
                    if(left_position == -100){
                        $(".rate-carousel .owl-stage").css({"transform": "translate3d(0px, 0px, 0px)", "transition": "transform .1s linear"});
                    }});
            }



        });
    </script>
@stop

