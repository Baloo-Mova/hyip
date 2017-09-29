@extends('Admin::index')

@section('content')
    @include('Admin::alerts')

    <div class="row">
        <div class="col-xs-12">
            <h3 class="sub-header">
                @if($type == 'all')
                    <a href="{{ route('admin.users.index') }}" class="btn btn-primary pull-right">Назад</a>
                @else
                    <a href="{{route('admin-users-list', ['type' => $type, 'val' => $val])}}" class="btn btn-primary pull-right" style="float: right;"> Назад</a>
                @endif
                Просмотр пользователя - {{ $user->login }}
                <a title="{{ $user->is_banned == 1 ? 'Розбанить':'Забанить'}}"
                   href="{{route('admin-users-ban', [
                               'id'=>$user->id,
                               'type'=>$user->is_banned==0?1:0,
                               'list_type' => $type,
                               'val' => $val
                           ])}}"
                   class="btn {{ $user->is_banned == 1 ? 'btn-success':'btn-warning' }}">
                    <i class="fa {{ $user->is_banned == 1 ? 'fa-unlock green':'fa-lock red'}} "></i>
                    {{ $user->is_banned == 1 ? 'Розбанить пользователя':'Забанить пользователя'}}
                </a>
            </h3>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-md-6">
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
                    <tr>
                        <td>Активность</td>
                        <td class="{{ isset($user->subscribe_id) ? "text-success" : "text-danger" }}">{{ isset($user->subscribe_id) ? "Активен" : "Не активен" }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="col-xs-12 col-md-6">
            <table class="table table-striped">
                <thead>
                    <th colspan="2">Финансы</th>
                </thead>
                <tbody>
                    <tr>
                        <td>Тариф</td>
                        <td>{{ isset($uer->subscribe_id) ? $user->subscription->name : "" }}</td>
                    </tr>
                    <tr>
                        <td>Денег заработано</td>
                        <td>{{ $sum_all }}₽</td>
                    </tr>
                    <tr>
                        <td>Денег выведено</td>
                        <td>{{ $paid_out }}₽</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-md-6">
            <table class="table table-striped">
                <thead>
                    <th colspan="2">Паспортные данные</th>
                </thead>
                <tbody>
                     @if(!isset($passport_data))
                         <tr>
                             <td colspan="2" class="text-center">Паспортные данные еще не указаны</td>
                         </tr>
                     @else
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
                            <td>Номер паспорта</td>
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
                     @endif
                </tbody>
            </table>
        </div>

        <div class="col-xs-12 col-md-6">
            <label for="">Сканы документов</label>
            <div class="p20">
                @forelse($scans as $scan)
                    <a href="{{ route('get.image', ['type' => 'scans', 'name' => $scan->photo]) }}" data-fancybox="group">
                        <img src="{{ route('get.image', ['type' => 'scans', 'name' => $scan->preview]) }}" class="w100" alt="">
                    </a>
                @empty
                    Нет загруженных сканов документов
                @endforelse
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <table class="table table-striped">
                <thead>
                    <th colspan="2">Рефералы</th>
                </thead>
                <tbody>
                    <tr>
                        <td>Всего рефералов</td>
                        @if(count($ref) > 0)
                            @foreach($ref as $r)
                                    <td>Рефералов {{ $r->level }} уровня</td>
                            @endforeach
                        @endif
                    </tr>
                    <tr>
                        <td>{{ $count }}</td>
                        @if(count($ref) > 0)
                            @foreach($ref as $r)
                                <td>{{ $r->count }}</td>
                            @endforeach
                        @endif
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-xs-12">
            <table class="table table-striped">
                <thead>
                <th colspan="2">Рефералы подробнее</th>
                </thead>
                <tbody>
                    <tr>
                        <td>Кто пригласил</td>
                        <td>{{ $ref_name }}</td>
                    </tr>
                    @if(count($refjoin) > 0)

                        <tr>
                            <td colspan="2"><strong>Кого пригласил:</strong></td>
                        </tr>

                        @foreach($refjoin as $item)
                            <tr>
                                <td colspan="2">{{ $item->user_ref_name }}</td>
                            </tr>
                        @endforeach

                    @endif
                </tbody>
            </table>
        </div>
        <div class="col-xs-12 text-center">
            {{ $refjoin->links() }}
        </div>
    </div>

@stop



