@extends('Admin::index')

@section('content')
    @include('Admin::alerts')

    <div class="row">
        <div class="col-xs-12">
            <h3 class="sub-header">
                <a href="{{route('admin-users-list', ['type' => $type, 'val' => $val])}}" class="btn btn-primary pull-right" style="float: right;"> Назад</a>
                Просмотр пользователя - {{ $user->login }}
            </h3>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-md-4">
            <table class="table table-striped">
                <thead>
                    <th colspan="2">Основная информация</th>
                </thead>
                <tbody>
                    <tr>
                        <td>Логин</td>
                        <td>{{ $user->login }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <td>Телефон</td>
                        <td>{{ $user->phone }}</td>
                    </tr>
                    <tr>
                        <td>Дата регистрации</td>
                        <td>{{ $user->created_at }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-md-4">
            <table class="table table-striped">
                <thead>
                    <th colspan="2">Паспортные данные</th>
                </thead>
                <tbody>
                    <tr>
                        <td>Имя</td>
                        <td>{{ $passport_data->name }}</td>
                    </tr>
                    <tr>
                        <td>Фамилия</td>
                        <td>{{ $passport_data->surname }}</td>
                    </tr>
                    <tr>
                        <td>Отчество</td>
                        <td>{{ $passport_data->middleName }}</td>
                    </tr>
                    <tr>
                        <td>Серия паспорта</td>
                        <td>{{ $passport_data->series }}</td>
                    </tr>
                    <tr>
                        <td>Еомер паспорта</td>
                        <td>{{ $passport_data->number }}</td>
                    </tr>
                    <tr>
                        <td>Кем выдан паспорт</td>
                        <td>{{ $passport_data->issuedby }}</td>
                    </tr>
                    <tr>
                        <td>Дата выдачи</td>
                        <td>{{ !empty($passport_data->dateofissue) ? \Carbon\Carbon::parse($passport_data->dateofissue)->format("d.m.Y") : "" }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

@stop



