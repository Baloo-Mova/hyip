@extends('Admin::index')

@section('content')
    @include('Admin::alerts')

    <div class="row">
        <div class="col-xs-12">
            <h3 class="sub-header">
                Пользователи
            </h3>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-md-4">
            <table class="table table-striped user_levels_table">
                <thead>
                    <tr>
                        <th>Кол-во реф-ов</th>
                        <th>Кол-во пользователей</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($table1 as $t1)
                        <tr>
                            <td>{{ $t1['level'] }}</td>
                            <td>
                                @if($t1['value'] > 0)
                                    <a href="{{ route('admin-users-list', ['type' => 1, 'val' => $t1['level']]) }}">{{ $t1['value'] }}</a>
                                @else
                                    {{ $t1['value'] }}
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center">Нет данных</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-md-4">
            <table class="table table-striped user_levels_table">
                <tbody>
                    <tr>
                        @foreach($table2 as $t2)
                            <td>{{ $t2['level'] }} ступень</td>
                        @endforeach
                    </tr>
                    <tr>
                        @foreach($table2 as $t2)
                            <td>
                                <a href="{{ route('admin-users-list', ['type' => 2, 'val' => $t2['level']]) }}">{{ $t2['value'] }}</a>
                            </td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

@stop



