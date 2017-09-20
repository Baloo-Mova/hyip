@extends('main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1 class="page-header">@lang('messages.input_output')</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <h2>{{ $data[$type]['title'] }}</h2>
                {!!  $data[$type]['description']  !!}
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

