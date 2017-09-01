@extends('dark')

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

            <div class="register-form__wrap">
                {!! Form::open(['url' => 'register', 'class' => 'form-signin']) !!}
                <div class="register-form__header">
                    <img src="img/logo.png" alt="">
                </div>
                <div class="register-form__title">
                    @if(isset($user))
                        {!! Form::hidden ('token', $user->ref_link) !!}
                        <span>
                            Вас пригласил <b>{{$user->login}}</b>
                        </span>
                    @endif
                </div>


                <div class="register-form__inputs">
                    <div class="form-group has-feedback {{ $errors->has('login') ? 'has-error' : false }}">
                        {!! Form::label('login', 'Логин', ['class' => 'control-label']) !!}
                        {!! Form::text('login', '', ['class' => 'form-control', 'id' => 'login', 'placeholder' => 'Логин', 'required', 'autofocus']) !!}
                    </div>
                    <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : false }}">
                        {!! Form::label('email', 'E-Mail', ['class' => 'control-label']) !!}
                        {!! Form::email('email', '', ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'mail@example.com', 'required']) !!}
                    </div>
                    <div class="form-group has-feedback {{ $errors->has('phone') ? 'has-error' : false }}">
                        {!! Form::label('phone', 'Телефон', ['class' => 'control-label']) !!}
                        {!! Form::text('phone', '', ['class' => 'form-control', 'id' => 'phone', 'placeholder' => '77777777777', 'required']) !!}
                    </div>
                    <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : false }}">
                        {!! Form::label('password', 'Пароль', ['class' => 'control-label']) !!}
                        {!! Form::password('password', ['class' => 'form-control', 'id' => 'password', 'placeholder' => 'Пароль', 'required']) !!}
                    </div>
                    <div class="form-group has-feedback {{ $errors->has('confirm_password') ? 'has-error' : false }}">
                        {!! Form::label('confirm-password', 'Повторите пароль', ['class' => 'control-label']) !!}
                        {!! Form::password('confirm_password', ['class' => 'form-control', 'id' => 'confirm-password', 'placeholder' => 'Пароль', 'required']) !!}
                    </div>
                </div>
                <div class="register-form__inputs-bottom">
                    <div class="register-form__inputs">
                        <div class="form-group has-feedback {{ $errors->has('confirm_regulations') ? 'has-error' : false }}">
                            <label for="">
                                <input type="checkbox" name="confirm_regulations">
                                Я подтверждаю, что внимательно прочел(-ла) и понял(-а) содержание всего <a href="#">текста</a>
                            </label>
                        </div>
                        {!! Form::submit('Регистрация', ['class' => 'btn btn-lg btn-main-carousel btn-block']) !!}


                        {!! Form::close() !!}
                    </div>
                </div>

            </div>
            <div class="register__add-buttons text-center">
                <a href="{{ route('index') }}">Главная</a>
            </div>

        </div>
    @endif
@endsection

@section('css')
    <style>
        .form-signin {
            width: 100%;
            padding: 0px;
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
