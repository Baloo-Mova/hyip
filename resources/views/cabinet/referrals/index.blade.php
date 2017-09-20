@extends('user')

@section('content')
    @include('alerts')
    <div class="row">
        <div class="col-xs-12">
            <h1 class="page-header">@lang("messages.referrals")</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="news__item refferals__wrap">
                <div class="row">
                    <div class="col-xs-12">
                        <p class="tariff___price f40">{{ $count }}</p>
                        <h4>@lang("messages.total_referrals")</h4>
                    </div>
                    <div class="col-xs-12">
                        <div class="info-carousel price-info__wrap">
                            @foreach($info as $item)
                                <div class="price-info-item">
                                    <p class="tariff___price">{{$item->count}}</p>
                                    <h4>@lang("messages.referrals") {{ $item->level}} @lang("messages.level")</h4>
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

    <div class="row">
        <div class="col-xs-12">
                <table class="table table-striped">
                    <thead>
                        <form action="{{ route('referrals.search') }}" method="post">
                            {{ csrf_field() }}
                            <tr>
                                <td>
                                    <input type="text" class="form-control btn-flat input_user_select" name="level" value="{{ isset($search['level']) ? $search['level'] : "" }}">
                                </td>
                                <td>
                                    <input type="text" class="form-control btn-flat input_user_select" name="user_ref_name" value="{{ isset($search['user_ref_name']) ? $search['user_ref_name'] : "" }}">
                                </td>
                                <td>
                                    <input type="text" class="form-control btn-flat input_user_select" name="user_ref_phone" value="{{ isset($search['user_ref_phone']) ? $search['user_ref_phone'] : "" }}">
                                </td>
                                <td>
                                    <input type="text" class="form-control btn-flat input_user_select date_range" name="date_range" value="{{ isset($search['date_range']) ? $search['date_range'] : "" }}">
                                </td>
                                <td>
                                </td>
                                <td>
                                    <a href="{{ route('referrals') }}" class="btn btn-flat btn-default">@lang("messages.clear")</a>
                                    <button type="submit" class="btn btn-flat btn-primary">@lang("messages.search")</button>
                                </td>
                            </tr>
                        </form>
                        <tr>
                            <th>@lang("messages.Level")</th>
                            <th>@lang("messages.login")</th>
                            <th>@lang("messages.phone")</th>
                            <th>@lang("messages.date_of_registration")</th>
                            <th>@lang("messages.brought")</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @if(count($referrals))
                        @foreach($referrals as $referral)
                            <tr>
                                <td>{{ $referral->level }}</td>
                                <td>{{ $referral->user_ref_name }}</td>
                                <td>{{ $referral->user_ref_phone }}</td>
                                <td>{{ \Carbon\Carbon::parse($referral->created_at)->format('d.m.Y') }}</td>
                                <td>{{ $referral->earned }}₽</td>
                                <td><a href="{{ route('create.chat', ['id' => $referral->user_ref]) }}">@lang("messages.send_message")</a></td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="text-center">
                                Нет рефералов
                            </td>
                        </tr>
                    @endif
                    </tbody>
                </table>
        </div>
        <div class="col-xs-12 text-center">
            {{ $referrals->links() }}
        </div>
    </div>
@stop

@section('js')
    <script>
        $("document").ready(function () {

            $('.date_range').daterangepicker({
                autoUpdateInput: false,
                locale: {
                    format: 'DD.MM.YYYY'
                }
            });

            $('.date_range').on('apply.daterangepicker', function (ev, picker) {
                $(this).val(picker.startDate.format('DD.MM.YYYY') + ' - ' + picker.endDate.format('DD.MM.YYYY'));
            });

            $('.date_range').on('cancel.daterangepicker', function (ev, picker) {
                $(this).val('');
            });

        });
    </script>
@stop