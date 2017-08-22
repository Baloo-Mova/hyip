<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    @include('partial.head')
    @yield('css')
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
</head>
<body>


<!-- Fixed navbar -->
<nav class="navbar navbar-default navbar-static-top">
    @include('partial.mainmenu')
</nav>

@yield('content')


<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <p>Все права защищены. 2017</p>
            </div>
        </div>
    </div>
</footer>

@include('partial.scripts')

<script>
    $(document).ready(function(){

    });
</script>
</body>
</html>
