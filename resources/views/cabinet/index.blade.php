@extends('user')

@section('content')
   @include('alerts')
    <h1 class="page-header">Личный кабинет пользователя</h1>
    <div class="row">
        <div class="col-xs-12">
            <div class="news__item row user__item">
                <div class="col-xs-12 text-center">
                    <div>
                        <img src="{{ asset('img/avatar.png') }}" alt="" class="user_avatar">
                        <h4>{{ $user->login }}</h4>
                        <h5>{{route('ref.add',['id'=>$user->ref_link])}}</h5>
                    </div>
                </div>
                <div class="col-xs-12 col-md-4">
                    <div class="user-info__item">
                        <a href="{{ isset($user->subscribe_id) ? route('tariff', ['id' => $user->subscribe_id]) : "#" }}" class="tariff___term">{{ isset($user->subscribe_id) ? $user->subscription->name : "-" }}</a>
                        <h4>Тариф</h4>
                    </div>
                </div>
                <div class="col-xs-12 col-md-4">
                    <div class="user-info__item">
                        <p class="tariff___term">{{ $user->balance }}₽</p>
                        <h4>Баланс</h4>
                    </div>
                </div>
                <div class="col-xs-12 col-md-4">
                    <div class="user-info__item">
                        <p class="tariff___term">{{ isset($user->subscribe_id) ? $payedForDiff->days. '  '.$payedForDiff->h.':'.$payedForDiff->i : "-"}}</p>
                        <h4>Тариф истечет через:</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection