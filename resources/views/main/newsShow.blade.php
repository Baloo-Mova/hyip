@extends('main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>{{ $data['news']['title'] }}</h1>
            </div>
        </div>
        <div class="row">
            <div class="news-show__item">
                <div class="col-xs-12">
                    <div class="news-show__img">
                        <img src="{{ asset($data['news']['img']) }}" alt="" class="">
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="news-show__text">
                        <p>
                            {{ $data['news']['text'] }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function () {

        });
    </script>
@stop

