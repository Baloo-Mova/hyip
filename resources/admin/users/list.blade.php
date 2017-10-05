@extends('Admin::index')

@section('content')
    @include('Admin::alerts')

    <div class="row">
        <div class="col-xs-12">
            <h1 class="sub-header">
                <a href="{{ route('admin.users.index') }}" class="btn btn-primary pull-right">Назад</a>
                Пользователи</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <table class="table table-striped">
                <thead>
                <tr>
                    <form action="{{ route('admin-users-list-search') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="type" value="{{ $type }}">
                        <input type="hidden" name="val" value="{{ $val }}">
                        <th class="w100"><input type="text" name="id" class="form-control" value="{{ isset($search['id']) ? $search['id'] : "" }}" placeholder="ID пользователя"></th>
                        <th><input type="text" name="email" class="form-control" value="{{ isset($search['email']) ? $search['email'] : "" }}" placeholder="email@gmail.com"></th>
                        <th><input type="text" name="login" class="form-control" value="{{ isset($search['login']) ? $search['login'] : "" }}" placeholder="Логин"></th>
                        <th><input type="text" name="ref_name" class="form-control" value="{{ isset($search['ref_name']) ? $search['ref_name'] : "" }}" placeholder="Кто пригласил"></th>
                        <th>
                            <select name="is_active" id="" class="form-control">
                                <option value="2" {{ isset($search['is_active']) && $search['is_active'] == 2 ? "selected" : "" }}>Все пользователи</option>
                                <option value="1" {{ isset($search['is_active']) && $search['is_active'] == 1 ? "selected" : "" }}>Активен</option>
                                <option value="0" {{ isset($search['is_active']) && $search['is_active'] == 0 ? "selected" : "" }}>Не активен</option>
                            </select>
                        </th>
                        <th></th>
                        <th class="w100"></th>
                        <th>
                            <select name="is_confirm" id="" class="form-control">
                                <option value="2" {{ isset($search['is_confirm']) && $search['is_confirm'] == 2 ? "selected" : "" }}>Все статусы</option>
                                <option value="1" {{ isset($search['is_confirm']) && $search['is_confirm'] == 1 ? "selected" : "" }}>Подтвержден</option>
                                <option value="0" {{ isset($search['is_confirm']) && $search['is_confirm'] == 0 ? "selected" : "" }}>Не подтвержден</option>
                            </select>
                        </th>
                        <th class="search_td">
                            @if($type == 'all')
                                <a href="{{ route('admin.users.index') }}" class="btn btn-default" title="Сбросить">
                                    <i class="fa fa-refresh" aria-hidden="true"></i>
                                </a>
                            @else
                                <a href="{{ route('admin-users-list', ['type' => $type, 'val' => $val]) }}" class="btn btn-default" title="Сбросить">
                                    <i class="fa fa-refresh" aria-hidden="true"></i>
                                </a>
                            @endif
                            <button class="btn btn-primary" type="submit">Найти</button></th>
                    </form>
                </tr>
                <tr>
                    <th>Id</th>
                    <th>Email</th>
                    <th>Логин</th>
                    <th>Кто пригласил</th>
                    <th>Активен ли</th>
                    <th>Баланс</th>
                    <th>Количество рефералов</th>
                    <th>Статус</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>
                            <a href="{{ route('admin.users.info', ['user_id' => $user->id, 'type' => $type, 'val' => $val]) }}">{{ $user->id }}</a>
                        </td>
                        <td>
                            <a href="{{ route('admin.users.info', ['user_id' => $user->id, 'type' => $type, 'val' => $val]) }}">{{$user->email}}</a>
                        </td>
                        <td>
                            <a href="{{ route('admin.users.info', ['user_id' => $user->id, 'type' => $type, 'val' => $val]) }}">{{$user->login}}</a>
                        </td>
                        <td>
                            @isset($user->referral_id)
                                <a href="{{ route('admin.users.info', ['user_id' => $user->referral_id, 'type' => $type, 'val' => $val]) }}">{{$user->ref_name}}</a>
                            @endisset
                        </td>
                        <td><span class="{{ isset($user->subscribe_id) ? "text-success" : "text-danger" }}">{{ isset($user->subscribe_id) ? "Активен" : "Не активен" }}</span></td>
                        <td>{{$user->balance}}₽</td>
                        <td>{{$user->ref_count}}</td>
                        <td>{{$user->is_confirm == 0 ? "Не подтвержден" : "Подтвержден"}}</td>
                        <td>
                            @if(!$user->is_confirm && isset($user->confirmed) && $user->confirmed->first())
                                <a title="Confirm" href="{{route('admin-users-confirm', [
                                    'id'=>$user->id,
                                    'type' => $type,
                                    'val' => $val
                                ])}}"><i
                                            class="fa fa-newspaper-o"></i></a>
                            @endif
                            <a title="Редактировать" href="{{route('admin.users.edit', ['id'=>$user->id, 'type' => $type, 'val' => $val] )}}"><i
                                        class="fa fa-edit"></i></a>
                            <a title="Забанить или розбанить"
                               href="{{route('admin-users-ban', [
                               'id'=>$user->id,
                               'type'=>$user->is_banned==0?1:0,
                               'list_type' => $type,
                               'val' => $val
                           ])}}"><i
                                        class="fa {{ $user->is_banned == 1?'fa-unlock green text-success':'fa-lock red text-danger'}} "></i></a>
                            <a title="Удалить" href="{{route('admin-users-delete', ['id'=>$user->id])}}"><i
                                        class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 text-center">
            {{ $users->links() }}
        </div>
    </div>




@endsection
@section('css')
    <style>
        .red {
            color: red;
        }

        .green {
            color: green;
        }
    </style>
@stop