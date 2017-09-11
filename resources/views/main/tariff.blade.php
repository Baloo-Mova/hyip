@extends('main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>Тарифы</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="owl-carousel rate-carousel">
                    @foreach($tariffs as $tariff)
                        <div class="rate-carousel-item">
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
                                @if(isset($tariff['first_prices']))
                                    @for($i = 0; $i < 3; $i++)
                                        @if(!isset($tariff['first_prices'][$i]))
                                            -
                                            <hr>
                                            @continue
                                        @else
                                            <p>{{ ($tariff['first_prices'][$i]['level'] + 1)." уровень -" }} {{ $tariff['first_prices'][$i]['is_percent'] ? $tariff['first_prices'][$i]['value']."%" : $tariff['first_prices'][$i]['value'] }}</p>
                                            <hr>
                                        @endif
                                    @endfor
                                @endif
                                <p>Срок действия: {{ $tariff['term'] }} дней</p>
                            </div>
                            <div class="rate__footer">
                                <a href="{{ url('register') }}" class="btn btn-main-carousel btn-md btn-flat rate-carousel__button">Оформить подписку</a>
                                <a href="#" class="btn btn-main-carousel btn-md btn-flat rate-carousel__button">Подробнее</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @if(!empty($tariff_info))
            <div class="row">
                <div class="col-xs-12">
                    <div class="news__item about-tariff__item">
                        <h3 class="tariff___name">{{ $tariff_info->name }}</h3>
                        <div class="col-xs-12 col-md-4">
                            <p class="tariff___ref-sys">{{ $tariff_info->levels }}</p>
                            <h4>Реферальная система</h4>
                        </div>
                        <div class="col-xs-12 col-md-4">
                            <p class="tariff___price">{{ $tariff_info->price }}</p>
                            <h4>Цена</h4>
                        </div>
                        <div class="col-xs-12 col-md-4">
                            <p class="tariff___term">{{ $tariff_info->term }}</p>
                            <h4>Срок действия</h4>
                        </div>
                        <div class="col-xs-12">
                            <div class="owl-carousel rate-carousel">
                                @foreach($tariff_info->firstPrices as $prices)
                                    <div class="rate-carousel-item">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="tariff___description">
                                <p>{{ $tariff_info->description }}</p>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('js')
    <script>
        $(function () {
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
                        items: 1,
                        stagePadding: 50
                    },
                    600: {
                        items: 3
                    },
                    1000: {
                        items: 4
                    }
                }
            });
        });
    </script>
@stop

