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
                                <img src="img/{{ random_int(1,3) }}.jpg" class="" alt="">
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
                                <a href="{{ route('about.tariffs') }}" class="btn btn-main-carousel btn-md btn-flat rate-carousel__button">Подробнее</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="news__item about-tariff__item">

                </div>
            </div>
        </div>
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
                center: true,
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
        });
    </script>
@stop

