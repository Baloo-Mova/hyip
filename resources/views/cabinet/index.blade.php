@extends('user')

@section('content')
   @include('alerts')
    <h1 class="page-header">Личный кабинет пользователя</h1>
    <div class="row">
        <div class="col-xs-12">
            <ul class="user-cabinet__menu">
                <li>Баланс: {{ $user->balance }}</li>
                @if(isset($user->subscribe_id))
                    <li>Ваш тариф: {{$user->subscription->name}}</li>
                    <li title="Срок действия тарифа">
                        Тариф истечет через: {{ $payedForDiff->days. '  '.$payedForDiff->h.':'.$payedForDiff->i }}
                    </li>
                @else
                    <li>Тариф отсутствует</li>
                @endif
                <li>Ваша реферальная ссылка: <b>{{route('ref.add',['id'=>$user->ref_link])}}</b></li>
            </ul>
        </div>
    </div>
@endsection