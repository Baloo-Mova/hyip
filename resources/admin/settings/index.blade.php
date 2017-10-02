@extends('Admin::index')

@section('content')
    @include('Admin::alerts')

    <div class="row">
        <div class="col-xs-12">
            <h3 class="sub-header">
                Настройки
            </h3>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <form action="" method="post">

                {{ csrf_field() }}

                <div class="row">
                    <div class="col-xs-12 col-md-4">
                        <div class="form-group @if( is_error('bonus_type') )has-error @endif">
                            <label for="">Состояние сайта:</label><br>
                            @if($state)
                                <a href="{{ route('admin.up.site') }}" class="btn btn-flat btn-success">Включить сайт</a>
                            @else
                                <a href="{{ route('admin.down.site') }}" class="btn btn-flat btn-danger">Выключить сайт</a>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-xs-12">
            <a href="{{ route('admin.settings.users') }}" class="btn btn-flat btn-primary">Настройки страницы пользователей</a>
        </div>
    </div>

    <hr>

    <div class="row">

        <div class="col-xs-12 col-md-4">
            <form action="{{ route('admin.settings.save') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="min_sum">Минимальная сумма для вывода</label>
                    <input type="text" class="form-control" name="min_sum" id="min_sum" value="{{ isset($settings->min_sum) ? $settings->min_sum : "" }}">
                </div>
                <div class="form-group">
                    <label for="max_sum">Максимальная сумма для вывода</label>
                    <input type="text" class="form-control" name="max_sum" id="max_sum" value="{{ isset($settings->max_sum) ? $settings->max_sum : "" }}">
                </div>
                <div class="form-group">
                    <label for="payeer_number">Payeer Number</label>
                    <input type="text" class="form-control" name="payeer_number" id="payeer_number" value="{{ isset($settings->payeer_number) ? $settings->payeer_number : "" }}">
                </div>
                <div class="form-group">
                    <label for="payeer_api_id">Payeer API Id</label>
                    <input type="text" class="form-control" name="payeer_api_id" id="payeer_api_id" value="{{ isset($settings->payeer_api_id) ? $settings->payeer_api_id : "" }}">
                </div>
                <div class="form-group">
                    <label for="payeer_api_key">Payeer API Key</label>
                    <input type="text" class="form-control" name="payeer_api_key" id="payeer_api_key" value="{{ isset($settings->payeer_api_key) ? $settings->payeer_api_key : "" }}">
                </div>
                <div class="form-group">
                    <label for="payeer_m_shop">Payeer M Shop</label>
                    <input type="text" class="form-control" name="payeer_m_shop" id="payeer_m_shop" value="{{ isset($settings->payeer_m_shop) ? $settings->payeer_m_shop : "" }}">
                </div>
                <div class="form-group">
                    <label for="payeer_m_key">Payeer M Key</label>
                    <input type="text" class="form-control" name="payeer_m_key" id="payeer_m_key" value="{{ isset($settings->payeer_m_key) ? $settings->payeer_m_key : "" }}">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </form>
        </div>

        <div class="col-xs-12 col-md-4">
            <form action="{{ route('admin.settings.save') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="smtp">SMTP</label>
                    <input type="text" class="form-control" name="smtp" id="smtp" value="{{ isset($settings->smtp) ? $settings->smtp : "" }}">
                </div>
                <div class="form-group">
                    <label for="smtp_port">SMTP Порт</label>
                    <input type="text" class="form-control" name="smtp_port" id="smtp_port" value="{{ isset($settings->smtp_port) ? $settings->smtp_port : "" }}">
                </div>
                <div class="form-group">
                    <label for="smtp_login">SMTP Логин</label>
                    <input type="text" class="form-control" name="smtp_login" id="smtp_login" value="{{ isset($settings->smtp_login) ? $settings->smtp_login : "" }}">
                </div>
                <div class="form-group">
                    <label for="smtp_pasw">SMTP Пароль</label>
                    <input type="text" class="form-control" name="smtp_pasw" id="smtp_pasw" value="{{ isset($settings->smtp_pasw) ? $settings->smtp_pasw : "" }}">
                </div>
                <div class="form-group">
                    <label for="smtp_secure">SMTP тип шифрования</label>
                    <select name="smtp_secure" class="form-control" id="smtp_secure">
                        <option value="ssl" {{ isset($settings->smtp_secure) && $settings->smtp_secure == 'ssl' ? "selected" : "" }}>SSL</option>
                        <option value="tls" {{ isset($settings->smtp_secure) && $settings->smtp_secure == 'tls' ? "selected" : "" }}>TLS</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </form>
        </div>

        <div class="col-xs-12 col-md-4">
            <form action="{{ route('admin.settings.save') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="admin_ips">Список IP (каждый с новой строки)</label>
                    <textarea name="admin_ips" id="admin_ips" rows="10" class="form-control">{!! isset($admin_ips) ? $admin_ips : ""  !!} </textarea>
                </div>
                <div class="form-group">
                    <button type="submit" name="ips" class="btn btn-primary">Сохранить</button>
                </div>
            </form>
        </div>
    </div>



@stop


