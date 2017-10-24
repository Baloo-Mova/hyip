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

    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>@lang('messages.tariffs')</h1>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="owl-carousel rate-carousel">
                    @foreach($tariffs as $tariff)
                        <div class="rate-carousel-item rate-carousel-item--info-page tariff_{{ $tariff['id'] }} {{ !empty($tariff_info) && $tariff_info->id == $tariff['id']  ? "active_tariff" : "" }}">
                            <div class="rate__img">
                                <img src="{{ route('get.image', ['type' => 'tariff', 'name' => $tariff['image']]) }}" class="" alt="">
                            </div>
                            <div class="rate__title">
                                <h3>{{ $tariff['name'] }}</h3>
                            </div>
                            <div class="rate__body">
                                <p class="rate__price">@lang('messages.price'): {{ $tariff['price'] }}₽</p>
                                <p class="reate__price_p">@lang('messages.ref_sys'): {{ $tariff['levels']." ".pluralForm($tariff['levels'], __("messages.levels_1"), __("messages.levels_2"), __("messages.levels_5")) }}</p>

                                <hr>
                                @if(isset($tariff->firstPrices))
                                    @for($i = 0; $i < 3; $i++)
                                        @if(!isset($tariff->firstPrices[$i]))
                                            -
                                            <hr>
                                            @continue
                                        @else
                                            <p>{{ ($tariff->firstPrices[$i]['level'] + 1)." ".__("messages.level") }} {{ $tariff->firstPrices[$i]['is_percent'] ? $tariff->firstPrices[$i]['value']."%" : $tariff->firstPrices[$i]['value']."₽" }}</p>
                                            <hr>
                                        @endif
                                    @endfor
                                @endif
                                <p>@lang('messages.validity'): {{ $tariff['term']." ".pluralForm($tariff['term'], __("messages.days_1"), __("messages.days_2"), __("messages.days_5")) }} </p>
                            </div>
                            <div class="rate__footer">
                                <a href=""
                                   class="btn btn-main-carousel btn-md btn-flat rate-carousel__button subscribe__button"
                                   data-toggle="modal"
                                   data-target="#myModal"
                                   data-price="{{ $tariff['price'] }}"
                                   data-name="{{ $tariff['name'] }}"
                                   data-levels="{{ $tariff['levels'] }}"
                                   data-validity="{{ $tariff['term'] }}"
                                   data-id="{{ $tariff['id'] }}"
                                >@lang('messages.subscribe')</a>
                                <a href="#"
                                   class="btn btn-main-carousel btn-md btn-flat rate-carousel__button tariff__choose"
                                   data-id="{{ $tariff['id'] }}">@lang('messages.more')</a>
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
                        <p class="tariff___ref-sys">{{ isset($tariff_info->levels) ? $tariff_info->levels." ".pluralForm($tariff_info->levels, __("messages.levels_1"), __("messages.levels_2"), __("messages.levels_5")) : "" }}</p>

                        <h4>@lang('messages.ref_sys')</h4>
                    </div>
                    <div class="col-xs-12 col-md-4">
                        <p class="tariff___price">{{ isset($tariff_info->price) ? $tariff_info->price."₽" : "" }}</p>
                        <h4>@lang('messages.price')</h4>
                    </div>
                    <div class="col-xs-12 col-md-4">
                        <p class="tariff___term">
                            {{ isset($tariff_info->term) ? $tariff_info->term." ".pluralForm($tariff_info->term, __("messages.days_1"), __("messages.days_2"), __("messages.days_5")) : "" }}
                        </p>
                        <h4>@lang('messages.validity')</h4>
                    </div>
                    <div class="col-xs-12">
                        <div class="info-carousel price-info__wrap">
                            @if(isset($tariff_info->firstPrices))
                                @foreach($tariff_info->firstPrices as $prices)
                                    <div class="price-info-item">
                                        <p class="tariff___price">{{$prices->value}}{{ $prices->is_percent == 1 ? "%" : "₽" }}</p>
                                        <h4>{{ intval($prices->level + 1)." ".__("messages.level")}}</h4>
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
        $(function () {
            var is_three = false,
                rateCarousel = $(".rate-carousel");

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


            $(".tariff__choose").on("click", function (e) {
                var scrollPosition = $(window).scrollTop();
                e.preventDefault();
                var id = $(this).data("id");
                $(".about-tariff__wrap").removeClass("hidden");
                $(".rate-carousel-item").removeClass("active_tariff");
                $('#preloader').fadeIn('slow', function () {
                    $(this).show();
                });
                $.ajax({
                    method: "get",
                    url: "{{ url('get-tariff-info') }}/" + id,
                    success: function (data) {
                        if (data.success == true) {
                            $('#preloader').fadeOut('slow', function () {
                                $(this).hide();
                            });
                            $(".tariff_" + id).addClass("active_tariff");

                            if(data.info.levels == 1){
                                lev = "{{ __('messages.level_1') }}";
                            }else{
                                if(data.info.levels > 1 && data.info.levels < 5){
                                    lev = "{{ __('messages.level_2-4') }}";
                                }else{
                                    lev = "{{ __('messages.level_5') }}";
                                }
                            }

                            $(".tariff___ref-sys").text(data.info.levels+" "+getNumEnding(data.info.levels, ['{{ __("messages.levels_1") }}', '{{ __("messages.levels_2") }}', '{{ __("messages.levels_5") }}']));
                            $(".tariff___name").text(data.info.name);
                            $(".tariff___price").text(data.info.price+"₽");
                            $(".tariff___term").text(data.info.term+" "+getNumEnding(data.info.term, ['{{ __("messages.days_1") }}', '{{ __("messages.days_2") }}', '{{ __("messages.days_5") }}']));
                            $(".tariff___description").text(data.info.description == null ? "{{ __("messages.this_tariff_has_no_description") }}" : data.info.description);

                            var prices = ''
                            tmp = "";
                            data.prices.forEach(function (item, i, arr) {
                                tmp = data.prices[i].is_percent == 1 ? "%" : "₽";
                                prices += '<div class="price-info-item"><p class="tariff___price">' + data.prices[i].value + tmp + '</p>' +
                                    '<h4>' + (parseInt(data.prices[i].level) + 1) + ' {{ __("messages.level") }}</h4></div>';

                            });
                            $(".info-carousel").html(prices);

                            if (scrollPosition < 343) {
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
                        items: 1
                    },
                    600: {
                        items: 3
                    },
                    1000: {
                        items: 3
                    }
                },
                onInitialized: function (e) {
                    if (this.items().length > 3) {
                        is_three = true;
                    }
                }
            });

            var left_position = 0;

            if (is_three) {
                $(".rate-carousel").on('mouseenter', function () {
                    left_position = $(".rate-carousel .owl-stage").position().left;
                    if (left_position == 0) {
                        left_position = left_position - 50;
                        $(".rate-carousel .owl-stage").css({
                            "transform": "translate3d(" + (left_position) + "px, 0px, 0px)",
                            "transition": "transform 1s linear"
                        });
                    }
                });
                $(".rate-carousel").on('mouseleave', function () {
                    left_position = $(".rate-carousel .owl-stage").position().left;
                    if (left_position == -50) {
                        $(".rate-carousel .owl-stage").css({
                            "transform": "translate3d(0px, 0px, 0px)",
                            "transition": "transform 1s linear"
                        });
                    }
                });
            }


        });
    </script>
@stop

