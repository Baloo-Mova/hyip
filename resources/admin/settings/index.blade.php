@extends('Admin::index')

@section('content')
    @include('Admin::alerts')

    <div>
        <h3 class="sub-header">
            Настройки
        </h3>
    </div>

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

@stop


