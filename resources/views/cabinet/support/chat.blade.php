<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel</title>
    @include('partial.head')
    @yield('css')
    <link rel="stylesheet" href="{{asset('css/user.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" href="{{asset('css/chat.css')}}">
    <style>
        .messages{
            padding-bottom: 50px;
        }
    </style>
</head>
<body class="chat_body">
@include('partial.mainmenu')
<div class="container-fluid h100">
    <div class="row h100">
        <div class="sidebar">
            @include('partial.usersidemenu')
        </div>
        <div class="col-sm-10 col-sm-offset-2 col-md-10 col-md-offset-2 main h100">
            <div id="chat" class="chat__wrap">
                <div class="h100">
                    <div class="row h100">
                        <div class="col-xs-12 h100">
                            <div class="news__item chat__wrap_wrapper">
                                <div class="chat__header">
                                    <h4>@lang("messages.contact_technical_support")</h4>
                                </div>
                                <div class="chat__body" @scroll="onScroll">
                                    <div class="messages">
                                        @forelse($feedbacks as $feedback)
                                            @if(isset($feedback->answer))
                                                <div>
                                                    <div class="from__message" id="bottom">
                                                        <p>
                                                            {!! $feedback->answer !!}
                                                        </p>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div class="from__message_info">
                                                        <p>
                                                            Support - {{ $feedback->created_at }}
                                                        </p>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            @endif
                                            <div class="chat__messages">
                                                <div>
                                                    <div class="to__message" id="bottom">
                                                        <p>
                                                            {!! $feedback->question !!}
                                                        </p>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div class="to__message_info">
                                                        <p>
                                                            {{ $feedback->name }} - {{ $feedback->created_at }}
                                                        </p>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div class="to__message_info">
                                                        <p class="lower-text">
                                                            @lang("messages.status") - {{ $feedback->is_reply == 0 ? __("messages.new") : __("messages.read") }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                        @endforelse
                                    </div>
                                </div>
                                <div class="chat__footer">
                                    <form action="{{ route('create-feedback') }}" method="post">
                                        {{ csrf_field() }}
                                        <input type="hidden" class="form-control btn-flat" name="name" id="name" value="{{ $user->login }}">
                                        <input type="hidden" class="form-control btn-flat" name="email" id="email" value="{{ $user->email }}">
                                        <textarea name="question" class="form-control btn-flat"></textarea>
                                        <button type="submit" class="btn btn-flat btn-main-carousel send__button">
                                            <span class="hidden-sm hidden-md hidden-lg">Отправить</span>
                                            <i class="fa fa-paper-plane-o fa-2x hidden-xs" aria-hidden="true"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>


