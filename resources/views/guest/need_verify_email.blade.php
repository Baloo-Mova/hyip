@extends('dark')

@section('content')
    <div class="container">
        <div class="register-form__wrap">
            <div class="register-form__header">
                <img src="img/logo.png" alt="">
            </div>
            <div class="register-form__inputs text-center">
                <h4>На Вашу электронную почту выслана инструкция для завершения регистрации.</h4>
            </div>

            <div class="register-form__inputs-bottom">
                <div class="register-form__inputs text-center">
                    <a href="{{ route('index') }}" class="btn btn-flat btn-main-carousel btn-lg">На главную</a>
                </div>
            </div>
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