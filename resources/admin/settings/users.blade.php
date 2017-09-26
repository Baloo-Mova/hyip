@extends('Admin::index')

@section('content')
    @include('Admin::alerts')

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="" method="post">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Добавление уровня</h4>
                    </div>
                    <div class="modal-body">
                        {{ csrf_field() }}
                        <input type="text" name="value" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                        <button type="submit" class="btn btn-primary">Добавить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <h3 class="sub-header">
                Настройки страницы пользователей
            </h3>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <button class="btn btn-success add_item" data-toggle="modal" data-target="#myModal">Добавить</button>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <table class="table table-striped user_levels_table">
                <thead>
                    <tr>
                        <th>Значение</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($levels as $level)
                        <tr>
                            <td>{{ $level->value }}</td>
                            <td>
                                <a href="{{ route('admin.settings.users.level.delete', ['id' => $level->id]) }}">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr class="no_items">
                            <td colspan="2">Нет значений</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@stop



