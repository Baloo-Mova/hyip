@extends('user')

@section('content')
    @include('alerts')
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
                <h2>Пополнить счет</h2>
                <div class="col-lg-4 col-xs-12">
                    <form action="{{route('facilities.refill')}}" method="POST">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="sum">
                                Сумма пополения:
                            </label>
                            <input type="number" name="count" class="form-control" placeholder="500">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-main-carousel btn-md btn-flat">
                        </div>
                    </form>
                </div>
            </div>
            <div class="tab-pane {{ $type == "output" ? "active" : "" }}" id="out">
                <h2>Вывести средства</h2>
            </div>
        </div>
    </div>
@endsection