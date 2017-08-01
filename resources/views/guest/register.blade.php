@extends('index')

@section('content')
    <div class="container">
        @if(Session::get('errors'))
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <ul>
                    @foreach($errors->all() as $message)
                        <li>{{$message}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <style>
            .form-signin {
                max-width: 330px;
                padding: 15px;
                margin: 0 auto;
            }
            .form-signin .form-control {
                position: relative;
                height: auto;
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
                padding: 10px;
                font-size: 16px;
            }
        </style>
        {!! Form::open(['url' => 'register', 'class' => 'form-signin']) !!}
                {!! Form::hidden ('token', $token) !!}
            <h2 class="form-signin-heading">Please sign in</h2>
            <div class="form-group has-feedback {{ $errors->has('login') ? 'has-error' : false }}">
                {!! Form::label('login', 'Login', ['class' => 'control-label']) !!}
                {!! Form::text('login', '', ['class' => 'form-control', 'id' => 'login', 'placeholder' => 'Login', 'required', 'autofocus']) !!}
            </div>
            <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : false }}">
                {!! Form::label('email', 'E-Mail Address', ['class' => 'control-label']) !!}
                {!! Form::email('email', '', ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Email address', 'required']) !!}
            </div>
            <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : false }}">
                {!! Form::label('password', 'Password', ['class' => 'control-label']) !!}
                {!! Form::password('password', ['class' => 'form-control', 'id' => 'password', 'placeholder' => 'Password', 'required']) !!}
            </div>
            <div class="form-group has-feedback {{ $errors->has('confirm_password') ? 'has-error' : false }}">
                {!! Form::label('confirm-password', 'Confirm password', ['class' => 'control-label']) !!}
                {!! Form::password('confirm_password', ['class' => 'form-control', 'id' => 'confirm-password', 'placeholder' => 'Confirm password', 'required']) !!}
            </div>
            {!! Form::submit('Register', ['class' => 'btn btn-lg btn-primary btn-block']) !!}
        {!! Form::close() !!}
    </div>

@endsection