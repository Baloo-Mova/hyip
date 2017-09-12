@extends('dark')

@section('content')
    <div class="container">

        <style>
            .form-signin {
                /*max-width: 330px;*/
                /*padding: 15px;*/
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



            <div class="register-form__wrap">
                {!! Form::open(['url' => 'login', 'class' => 'form-signin']) !!}
                <div class="register-form__header">
                    <img src="img/logo.png" alt="">
                </div>
                <div class="register-form__title">
                    @if(Session::get('errors'))
                        <div class="register-form__inputs hide-on-click">
                            <div class="alert alert-danger alert-dismissable btn-flat">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <ul>
                                    @foreach($errors->all() as $message)
                                        <li>{{$message}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="register-form__inputs">
                    <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : false }}">
                        {!! Form::label('email', 'E-Mail', ['class' => 'control-label']) !!}
                        {!! Form::email('email', '', ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Email address', 'required']) !!}
                    </div>
                    <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : false }}">
                        {!! Form::label('password', 'Пароль', ['class' => 'control-label']) !!}
                        {!! Form::password('password', ['class' => 'form-control', 'id' => 'password', 'placeholder' => 'Password', 'required']) !!}
                    </div>
                </div>

                <div class="register-form__inputs-bottom">
                    <div class="register-form__inputs">
                        {!! Form::submit('Войти', ['class' => 'btn btn-lg btn-main-carousel btn-block']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        <div class="register__add-buttons text-center">
            <a href="{{ route('index') }}">Назад</a>
        </div>
    </div>

@endsection

@section('js')
    <script>
        $(document).ready(function(){
            $(".close").on("click", function(){
               $(".hide-on-click").hide();
            });
        });

    </script>
@stop