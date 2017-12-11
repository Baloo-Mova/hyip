@extends('dark')

@section('content')

    @if($errors->has('userWithIpExist'))
        <div class="container">
            <div class="register-form__wrap">
                <div class="register-form__header">
                    <img src="{{url('img/logo.png')}}" alt="">
                </div>
                <div class="register-form__inputs hide-on-click">
                    <div class="alert alert-danger alert-dismissable btn-flat">
                        С данного IP: {{$errors->first('userWithIpExist')}} регистрация не возможна
                    </div>
                </div>
                <div class="register-form__inputs-bottom">
                    <div class="register-form__inputs text-center">
                        <a href="{{ route('index') }}" class="btn btn-flat btn-main-carousel btn-lg">На главную</a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="container">


            <div class="register-form__wrap">
                {!! Form::open(['route' => 'register', 'class' => 'form-signin']) !!}
                <div class="register-form__header">
                    <img src="{{url('img/logo.png')}}" alt="">
                </div>
                <div class="register-form__title">
                    @if(Session::get('errors'))
                        <div class="register-form__inputs hide-on-click">
                            <div class="alert alert-danger alert-dismissable btn-flat">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;
                                </button>
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
                    <div class="form-group has-feedback {{ $errors->has('login') ? 'has-error' : false }}">
                        {!! Form::label('login', __('messages.user_login'), ['class' => 'control-label']) !!}
                        {!! Form::text('login', '', ['class' => 'form-control', 'id' => 'login', 'placeholder' => __('messages.login'), 'required', 'autofocus']) !!}
                    </div>
                    <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : false }}">
                        {!! Form::label('email', 'E-Mail', ['class' => 'control-label']) !!}
                        {!! Form::email('email', '', ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'mail@example.com', 'required']) !!}
                    </div>
                    <div class="form-group has-feedback {{ $errors->has('phone') ? 'has-error' : false }}">
                        {!! Form::label('phone', __('messages.phone'), ['class' => 'control-label']) !!}
                        {!! Form::text('phone', '', ['class' => 'form-control', 'id' => 'phone', 'placeholder' => '77777777777', 'required']) !!}
                    </div>
                    <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : false }}">
                        {!! Form::label('password', __('messages.password'), ['class' => 'control-label']) !!}
                        {!! Form::password('password', ['class' => 'form-control', 'id' => 'password', 'placeholder' => __('messages.password'), 'required']) !!}
                    </div>
                    <div class="form-group has-feedback {{ $errors->has('confirm_password') ? 'has-error' : false }}">
                        {!! Form::label('confirm-password', __('messages.confirm_password'), ['class' => 'control-label']) !!}
                        {!! Form::password('confirm_password', ['class' => 'form-control', 'id' => 'confirm-password', 'placeholder' => __('messages.password'), 'required']) !!}
                    </div>
                    <div class="form-group has-feedback">
                        @if(isset($user))
                            {!! Form::hidden ('token', $user->ref_link) !!}
                            <span>
                            Вас пригласил <b>{{$user->login}}</b>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="register-form__inputs-bottom">
                    <div class="register-form__inputs">
                        <div class="form-group has-feedback {{ $errors->has('confirm_regulations') ? 'has-error' : false }}">
                            <label for="">
                                <input type="checkbox" name="confirm_regulations" class="confirm_regulations">
                                <?php
                                    $one = "<a href=".route('about', ['#documents'])." target='_blank' class='red-text'>".__('messages.one_text').'</a>';
                                    $two = "<a href=".route('terms.of.use')." target='_blank' class='red-text'>".__('messages.two_text').'</a>';
                                    $three = "<a href=".route('about', ['#documents'])." target='_blank' class='red-text'>".__('messages.three_text').'</a>';
                                ?>
                                @lang('messages.register_long_text', ['one' => $one, 'two' => $two, 'three' => $three])
                            </label>
                        </div>
                        {!! Form::submit(__('messages.register'), ['class' => 'btn btn-lg btn-main-carousel btn-block register-button']) !!}


                        {!! Form::close() !!}
                    </div>
                </div>

            </div>
            <div class="register__add-buttons text-center">
                <a href="{{ route('index') }}">@lang('messages.home')</a>
            </div>

        </div>
    @endif
@endsection

@section('css')
    <style>
        body {
            padding-top: 50px !important;
            padding-bottom: 0px !important;
        }

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

@section('js')
    <script>
        $(document).ready(function () {
            /* $(".register-button").prop("disabled", true);
            $(".confirm_regulations").on("change", function () {
                var state = $(this).prop("checked");
                if(state){
                    $(".register-button").prop("disabled", false);
                }else{
                    $(".register-button").prop("disabled", true);
                }
            });*/
            $(".close").on("click", function () {
                $(".hide-on-click").hide();
            });
        });
    </script>
@stop
