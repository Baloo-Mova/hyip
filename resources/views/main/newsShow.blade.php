@extends('main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>{{ $data['news']['title'] }}</h1>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="news-show__item">
                <div class="col-xs-12">
                    <div class="news-show__text">
                        <p>
                            <img src="{{ asset('media/uploads/blog').'/'.$data['news']['preview'] }}" alt="" class="news-show__img">
                            {!!  $data['news']['content'] !!}
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

