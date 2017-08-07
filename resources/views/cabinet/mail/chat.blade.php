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
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">    </head>
<body>
    <style>
        body {
            padding: 51px 0 149px;
        }
        .message {
            padding: 10px 20px;
        }
        .message.no_read {
            background-color: rgb(237, 240, 245);
        }
        .send-form {
            background: #fff;
            border-top: 1px solid rgb(228, 230, 233);
            padding: 10px 0 0;
        }
    </style>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/">Logo</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="/">Home</a></li>
                        <li><a href="/about">About</a></li>
                        <li><a href="/contacts">Contacts</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                {!! Auth::user()->login !!} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ url('/cabinet') }}">Cabinet</a></li>
                                <li><a href="{{ url('/cabinet/referrals') }}">Referrals</a></li>
                                <li><a href="{{ url('/cabinet/dialogs') }}">Dialogs</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="{{ url('/logout') }}">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
        @if(count($chat))
            <div class="messages-container">
                <div class="container">
                    <div class="messages">
                        @foreach( $chat as $message )
                            @if( !$from_user = $message->from_user )
                                @continue
                            @endif

                            <div class="message @if(!$message->is_read) no_read @endif">
                                <div class="comm_list__item__con__title">
                                    <div class="cab__title"><a href="/profile/{{ $from_user->id }}">{{ $from_user->login }}</a></div>
                                    <span class="comm_list__item__con__title__date">{{ $message->created_at->format('d.m.Y H:i') }}</span>
                                </div>
                                <p class="thumb_prof__con__desc">{{ $message->message }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @else
            <div class="container">
                <div class="cab__title">No messages</div>
            </div>
        @endif
    <div class="navbar-fixed-bottom send-form">
        <div class="container">
            {!! Form::open(['url' => '/cabinet/dialogs/create']) !!}
            {!! Form::hidden('to_user', $to_user->id) !!}
            <div class="form-group {{ $errors->has('message') ? 'has-error' : false }}">
                {!! Form::textarea('message', '', ['class' => 'form-control', 'rows' => '3', 'style' => 'resize: none;']) !!}
            </div>
            <div class="form-group">
                {!! Form::submit('Send', ['class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    <script
            src="https://code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>
</body>
</html>