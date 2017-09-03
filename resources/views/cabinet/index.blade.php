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
        <div class="col-xs-12">
            <ul class="user-cabinet__menu">
                <li>Баланс: {{ $user->balance }}</li>
                @if(isset($user->subscribe_id))
                    <li>Ваш тариф: {{$user->subscription->name}}</li>
                    <li title="Срок действия тарифа">

                        Тариф истечет через: {{ date('d H:i:s',strtotime($user->subscribedFor) - time()) }}
                    </li>
                @else
                    <li>Тариф отсутствует</li>
                @endif
                <li>Ваша реферальная ссылка: <b>{{route('register.referral',['token'=>$user->ref_link])}}</b></li>
            </ul>
        </div>
    </div>
@endsection