<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="WhiteCoin">
    <link rel="icon" sizes="192x192" href="{{ asset('img/logo_md.png') }}">
    <meta content="{{ asset('img/logo_md.png') }}" property="og:image" />
    <meta content="{{env('APP_NAME')}}" property="og:site_name" />
    <meta content="object" property="og:type" />
    <meta content="WhiteCoin" property="og:title" />
    <meta content="Описание" property="og:description" />
    <title>{{env('APP_NAME')}}</title>
    @include('partial.head')
    @yield('css')
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
</head>
<body class="dark__wrap">

@yield('content')

@include('partial.scripts')
@yield('js')
</body>
</html>