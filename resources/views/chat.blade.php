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
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" href="{{asset('css/chat.css')}}">
</head>
<body>
@include('partial.mainmenu')

<div id="chat" class="chat__wrap">
    <chat_wrap></chat_wrap>
</div>

@include('partial.footer')

<script>
    window.chat_id = "{{ $chat->id }}";
    window.creator_id = "{{ $chat->creator_id }}";
    window.to_id = "{{ $chat->to_id }}";
    window.my_id = "{{ \Auth::id() }}";
    window.user_name = "{{ $chat->user_name->login }}";
</script>
<script src="../../../js/app.js" charset="utf-8"></script>
</body>
</html>
