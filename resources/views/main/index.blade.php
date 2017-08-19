@extends('index')

@section('content')
    <section class="caruselHeader">
        <div id="mainHead" class="owl-carousel">
            <div class="item" style="background-image:url('{{route('file',['name'=>'1.jpg'])}}')">
                <div class="container">
                    <div class="carousel-text__item">
                        <span>Тут будет какой то текст</span>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="item" style="background-image:url('{{route('file',['name'=>'2.jpg'])}}')">
                <div class="container">
                    <div class="carousel-text__item">
                        <span>Тут будет какой то текст</span>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('css')
    <style>
        .carousel-text__item {
            width: 100%;
            font-size: 32px;
            text-align: center;
            margin-top: 200px;
            height:400px;
        }

        .item {
            background-repeat: no-repeat;
            background-size: cover;
            color: rgb(255, 255, 255);
            height: 700px;
        }
    </style>
@stop
@section('js')
    <script>
        $(function () {
            $('#mainHead').owlCarousel({
                //autoplay: true,
                items: 1,
                dots: false,
                nav: false,
                loop: true,
                //autoplayTimeout: 5000
            });
        });
    </script>
@stop

