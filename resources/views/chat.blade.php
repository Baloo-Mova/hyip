<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="WhiteCoin">
    <link rel="icon" sizes="192x192" href="{{ asset('img/logo_md.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="{{ asset('img/logo_md.png') }}" property="og:image" />
    <meta content="{{env('APP_NAME')}}" property="og:site_name" />
    <meta content="object" property="og:type" />
    <meta content="WhiteCoin" property="og:title" />
    <meta content="Описание" property="og:description" />
    <title>{{env('APP_NAME')}}</title>
    @include('partial.head')
    @yield('css')
    <link rel="stylesheet" href="{{asset('css/user.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" href="{{asset('css/chat.css')}}">
</head>
<body class="chat_body">
<div class="user__sidebar__wrap">
    <i class="fa fa-bars phpdebugbar-fa-2x user__sidebar__call" aria-hidden="true"></i>
</div>
@include('partial.mainmenu')
<div class="container-fluid h100">
    <div class="row h100">
        <div class="sidebar">
            @include('partial.usersidemenu')
        </div>
        <div class="col-sm-10 col-sm-offset-2 col-md-10 col-md-offset-2 main h100">
            <div id="chat" class="chat__wrap">
                <chat_wrap></chat_wrap>
            </div>
        </div>
    </div>
</div>



@include('partial.footer')
<script
        src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script>
    window.chat_id = "{{ $chat->id }}";
    window.creator_id = "{{ $chat->creator_id }}";
    window.to_id = "{{ $chat->to_id }}";
    window.my_id = "{{ \Auth::id() }}";
    window.user_name = "{{ $chat->user_name->role == 2 ? 'ADMIN' : $chat->user_name->login }}";
    window.main_title = "{{ __("messages.chat_with_the_user") }}";
    window.you = "{{ __("messages.you") }}";
</script>
<script>
    $(document).ready(function(){
        $(".user__sidebar__call").on("click", function () {
            var state = $(".sidebar").css("display");

            if(state == "block"){
                $(".sidebar").hide(100);
            }else{
                $(".sidebar").show(100);
            }
        });
    });
</script>
<script src="../../../js/app.js" charset="utf-8"></script>
</body>
</html>
