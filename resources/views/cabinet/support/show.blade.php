@extends('user')

@section('content')
    @include('alerts')
    <div class="row">
        <div class="col-xs-12">
            <h1 class="page-header">@lang("messages.support") - @lang("messages.view_a_post")</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="news__item input-budjet__wrap">
                <table class="table table-striped" style="margin-bottom: 0px;">
                    <tr>
                        <td>@lang("messages.question")</td>
                        <td>{{ $feedback->question  }}</td>
                    </tr>
                    <tr>
                        <td>@lang("messages.answer")</td>
                        <td>{{ isset($feedback->answer) ? $feedback->answer : "-"  }}</td>
                    </tr>
                    <tr>
                        <td>@lang("messages.date")</td>
                        <td>{{ \Carbon\Carbon::parse($feedback->created_at)->format("d.m.Y h:i")  }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>


@endsection