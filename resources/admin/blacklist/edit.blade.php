@extends('Admin::index')

@section('content')
    @include('Admin::alerts')

        <div>
            <a href="{{ route('admin.blacklist') }}" class="btn-sm btn-primary pull-right">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
                &nbsp;&nbsp;
                назад
            </a>

            <h3 class="sub-header">
                Пользователи в черном листе
            </h3>
        </div>

    <div class="row">
        <form method="POST" class="form">

            {{ csrf_field() }}

            <div class="col-md-4">
                <div class="form-group">
                    <label for="login">Логин</label>
                    <input type="text"
                           value="{{ $item->login }}"
                           id="login"
                           class="form-control"
                           maxlength="255"
                           required
                           readonly
                    >
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text"
                           value="{{ $item->email }}"
                           id="email"
                           class="form-control"
                           maxlength="255"
                           required
                           readonly
                    >
                </div>

                <div class="form-group">
                    <label for="phone">Телефон</label>
                    <input type="text"
                           value="{{ $item->phone }}"
                           id="phone"
                           class="form-control"
                           maxlength="255"
                           required
                           readonly
                    >
                </div>

                <div class="form-group">
                    <label for="balance">Баланс</label>
                    <input type="text"
                           value="{{ $item->balance }}"
                           id="balance"
                           class="form-control"
                           maxlength="255"
                           required
                           readonly
                    >
                </div>

                <div class="form-group">
                    <label for="referrer-email">Реферрер</label>
                    <input type="text"
                           value="{{ !empty($item->referrer) ? $item->referrer->email : '' }}"
                           id="referrer-email"
                           class="form-control"
                           maxlength="255"
                           required
                           readonly
                    >
                </div>

                <div class="form-group">
                    <input type="checkbox"
                           name="banned"
                           id="banned"
                           @if($item->is_banned) checked @endif
                    >
                    <label for="banned">Забанен</label>
                </div>
            </div>

            <div class="col-md-12">
                <button class="btn btn-primary">
                    <i class="fa fa-floppy-o" aria-hidden="true"></i>
                    &nbsp;&nbsp;
                    Сохранить
                </button>
            </div>

        </form>
    </div>

@endsection