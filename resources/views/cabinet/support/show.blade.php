@extends('user')

@section('content')
    @include('alerts')
    <div class="row">
        <div class="col-xs-12">
            <h1 class="page-header">@lang("messages.support_message")
                <small>{{ \Carbon\Carbon::parse($feedback->created_at)->format("d.m.Y h:i")  }}</small>
                <a href="{{ route('support') }}" class="btn btn-main-carousel pull-right btn-flat">Назад</a>
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="news__item input-budjet__wrap p20">
                <label for="">@lang("messages.question"):</label>
                <p>
                    {{ $feedback->question  }}
                </p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="news__item input-budjet__wrap p20">
                <label for="">@lang("messages.answer"):</label><br>
                {!!  isset($feedback->answer) ? $feedback->answer : "-"  !!}
            </div>
        </div>
    </div>


@endsection