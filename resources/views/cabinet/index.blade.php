@extends('user')

@section('content')
   @include('alerts')
    <h1 class="page-header">@lang("messages.user_cabinet")</h1>
    <div class="row">
        <div class="col-xs-12 ">
            <div class="news__item user__item">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <div class="user-info__item">
                            <h4>@lang("messages.ref_link"):</h4>
                            <h5 class="user__item_referal">{{route('ref.add',['id'=>$user->ref_link])}}</h5>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-4">
                        <div class="user-info__item">
                            <a href="{{ isset($user->subscribe_id) ? route('tariff', ['id' => $user->subscribe_id]) : "#" }}" class="tariff___term">{{ isset($user->subscribe_id) ? $user->subscription->name : "-" }}</a>
                            <h4>@lang("messages.tariff")</h4>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-4">
                        <div class="user-info__item">
                            <p class="tariff___term">{{ $user->balance }}₽</p>
                            <h4>@lang("messages.balance")</h4>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-4">
                        <div class="user-info__item">
                            <?php
                                $hours = $payedForDiff->h < 10 ? '0'.$payedForDiff->h : $payedForDiff->h;
                                $minutes = $payedForDiff->i < 10 ? '0'.$payedForDiff->i : $payedForDiff->i;
                            ?>
                            <p class="tariff___term">{{ isset($user->subscribe_id) ? $payedForDiff->days. ' дн.  '.$hours.':'.$minutes : "-"}}</p>
                            <h4>@lang("messages.tariff_expires_in"):</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   <div class="row">
       <div class="col-xs-12">
           <div class="news__item refferals__wrap">
               <div class="row">
                   <div class="col-xs-4">
                       <p class="tariff___price f40">{{ $sum_all }}₽</p>
                       <h4>@lang("messages.total_earned")</h4>
                   </div>
                   <div class="col-xs-4">
                       <p class="tariff___price f40">{{ $count }}</p>
                       <h4>@lang("messages.total_referrals")</h4>
                   </div>
                   <div class="col-xs-4">
                       <p class="tariff___price f40">{{ $sum_out }}₽</p>
                       <h4>@lang("messages.means_application_withdrawal")</h4>
                   </div>
                   <div class="col-xs-12">
                       <div class="info-carousel price-info__wrap">
                           @foreach($info as $item)
                               <div class="price-info-item">
                                   <p class="tariff___price">{{$item->count}}</p>
                                   <h4>@lang("messages.referrals") {{ $item->level}} @lang("messages.level_2-4")</h4>
                               </div>
                           @endforeach
                       </div>
                   </div>
               </div>
               <div class="row">

               </div>
           </div>
       </div>
   </div>

@endsection