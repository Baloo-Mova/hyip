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
                @if (Session::has('messages'))
                    @foreach (Session::get('messages') as $message)
                        <div class="alert alert-success btn-flat">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <p>{!!  $message !!}</p>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="register-form__inputs">
                <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : false }}">
                    {!! Form::label('email', 'E-Mail', ['class' => 'control-label']) !!}
                    {!! Form::email('email', '', ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'example@gmai.com', 'required']) !!}
                </div>
                <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : false }}">
                    {!! Form::label('password', __('messages.password'), ['class' => 'control-label']) !!}
                    {!! Form::password('password', ['class' => 'form-control', 'id' => 'password', 'placeholder' => __('messages.password'), 'required']) !!}
                </div>
            </div>

            <div class="register-form__inputs-bottom">
                <div class="register-form__inputs">
                    {!! Form::submit(__('messages.login'), ['class' => 'btn btn-lg btn-main-carousel btn-block']) !!}
                    <a href="{{route('register')}}" class="btn btn-lg btn-main-carousel btn-block register"> @lang("messages.register") </a>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="register__add-buttons text-center">
            <a href="{{ route('password.reset') }}">@lang("messages.forgot_password")?</a>&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="{{ route('index') }}">@lang("messages.home")</a>
        </div>
    </div>

@endsection

@section('css')
    <style>
        body {
            padding-top: 50px !important;
            padding-bottom: 0px !important;
        }
        .btn-block{
            width:45% !important;
            display: inline-block;
            border-radius:0px;
            margin-top:0px!important;
        }
        .register{
            float: right;
        }
    </style>
@stop


@section('js')
    <script>
        $(document).ready(function () {
            $(".close").on("click", function () {
                $(".hide-on-click").hide();
            });
        });

    </script>
@stop