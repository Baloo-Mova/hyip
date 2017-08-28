@extends('index')

@section('content')

    @if($errors->has('userWithIpExist'))
        С данного IP: {{$errors->first('userWithIpExist')}} регистрация не возможна
    @else
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

            {!! Form::open(['url' => 'register', 'class' => 'form-signin']) !!}

            <h2 class="form-signin-heading">Регистрация</h2>
            @if(isset($user))
                {!! Form::hidden ('token', $user->ref_link) !!}
                <span>
                Вас пригласил <b>{{$user->login}}</b>
            </span>
            @endif

            <div class="form-group has-feedback {{ $errors->has('login') ? 'has-error' : false }}">
                {!! Form::label('login', 'Логин', ['class' => 'control-label']) !!}
                {!! Form::text('login', '', ['class' => 'form-control', 'id' => 'login', 'placeholder' => 'Логин', 'required', 'autofocus']) !!}
            </div>
            <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : false }}">
                {!! Form::label('email', 'E-Mail', ['class' => 'control-label']) !!}
                {!! Form::email('email', '', ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'mail@example.com', 'required']) !!}
            </div>
            <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : false }}">
                {!! Form::label('password', 'Пароль', ['class' => 'control-label']) !!}
                {!! Form::password('password', ['class' => 'form-control', 'id' => 'password', 'placeholder' => 'Пароль', 'required']) !!}
            </div>
            <div class="form-group has-feedback {{ $errors->has('confirm_password') ? 'has-error' : false }}">
                {!! Form::label('confirm-password', 'Повторите пароль', ['class' => 'control-label']) !!}
                {!! Form::password('confirm_password', ['class' => 'form-control', 'id' => 'confirm-password', 'placeholder' => 'Пароль', 'required']) !!}
            </div>
            {!! Form::submit('Регистрация', ['class' => 'btn btn-lg btn-primary btn-block']) !!}


            {!! Form::close() !!}
        </div>
    @endif
@endsection

@section('css')
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
@stop
