@extends('main')

@section('content')
    <div class="container">
        <h1 class="page-header">Ввод/вывод </h1>
        <div id="exTab2" class="">
            <ul class="nav nav-tabs">
                <li class="{{ $type == "input" ? "active" : "" }}">
                    <a href="#in" data-toggle="tab">Пополнить счет</a>
                </li>
                <li class="{{ $type == "output" ? "active" : "" }}">
                    <a href="#out" data-toggle="tab">Вывести средства</a>
                </li>
            </ul>

            <div class="tab-content ">
                <div class="tab-pane {{ $type == "input" ? "active" : "" }}" id="in">
                    <h2>{{ $data['input']['title'] }}</h2>
                    {{ $data['input']['description'] }}
                </div>
                <div class="tab-pane {{ $type == "output" ? "active" : "" }}" id="out">
                    <h2>{{ $data['output']['title'] }}</h2>
                    {{ $data['output']['description'] }}
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

