@extends('main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>{{ isset($data['content']->title) ? $data['content']->title : "Правила" }}</h1>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                {!! isset($data['content']->content) ? $data['content']->content : "" !!}
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

