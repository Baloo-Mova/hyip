@extends('user')

@section('content')
    @include('alerts')

    <h1 class="page-header">Ввод/вывод </h1>

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
@endsection