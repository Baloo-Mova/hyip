@extends('Admin::index')

@section('content')
    @include('Admin::alerts')

    <div>
        <h1 class="sub-header">Редактироать заявку ID: {{$withdraw->id}}</h1>
    </div>
    <div class="col-xs-12 col-lg-6">
        <div class="box">
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
                        <td>ID</td>
                        <td>{{ $withdraw->id }}</td>
                    </tr>
                    <tr>
                        <td>Сумма</td>
                        <td>{{ $withdraw->value }}₽</td>
                    </tr>
                    <tr>
                        <td>Пользователь id</td>
                        <td><a href="{{ route('admin-users-update', ['id' => $withdraw->from_id]) }}" target="_blank">{{ $withdraw->from_id }}</a></td>
                    </tr>
                    <tr>
                        <td>Время</td>
                        <td>{{ \Carbon\Carbon::parse($withdraw->time)->format('d.m.Y H:i') }}</td>
                    </tr>
                </table>
                <form action="" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="wid" value="{{ $withdraw->id }}">
                    <div class="form-group">
                        <label for="comment">Комментарий</label>
                        <textarea name="comment" id="comment" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="accept" value="Принять" class="btn btn-flat btn-success">
                        <input type="submit" name="decline" value="Отклонить" class="btn btn-flat btn-warning">
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection