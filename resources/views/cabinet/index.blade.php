@extends('user')

@section('content')
        @if(Session::get('errors'))

            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <ul>
                    @foreach($errors->all() as $message)
                        <li>{{$message}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <h1 class="page-header">Личный кабинет пользователя</h1>
        <div class="row">
            <div class="col-xs-12 col-md-4">
                <ul class="user-cabinet__menu">
                    <li>Баланс: {{ $user->balance }}</li>
                    <li>Базовый тариф</li>
                    <li title="Срок действия тарифа">
                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                        10.2.22
                    </li>
                    <li>
                        информация о рефералах
                    </li>
                </ul>
            </div>
        </div>
@endsection