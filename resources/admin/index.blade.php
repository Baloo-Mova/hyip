<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('/admin-cabinet/bootstrap/css/bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('/admin-cabinet/dist/css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('/admin-cabinet/css/AdminLTE.css')}}">
    <link rel="stylesheet" href="{{asset('/admin-cabinet/css/skins/_all-skins.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/social-networks.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.1.20/jquery.fancybox.min.css" />
    <![endif]-->
    @stack('header-scripts')
    @yield('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.1.20/jquery.fancybox.min.css" />
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('index') }}">AdminTemplate</a>
        </div>
            <a class="navbar-brand pull-right" href="{{ route('logout') }}">Logout</a>
    </div>
</nav>
<div class="container-fluid">
    <div class="row">
        @include('Admin::sidebar')
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            @yield('content')
        </div>
    </div>
</div>
<script src="{{asset('/admin-cabinet/plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
<script src="{{asset('/admin-cabinet/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('/admin-cabinet/js/adminlte.js')}}"></script>
<script src="{{asset('/admin-cabinet/js/app.js')}}"></script>
@stack('footer-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.1.20/jquery.fancybox.min.js"></script>
@yield('js')
</body>
</html>