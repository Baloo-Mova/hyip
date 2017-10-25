@extends('Admin::index')

@section('content')
    @include('Admin::alerts')
    <div class="row">
        <div class="col-xs-12">
            <a href='{{ route('admin.bonus.create') }}' class="btn-sm btn-primary pull-right">
                <i class="fa fa-plus-square" aria-hidden="true"></i>
                Добавить
            </a>
            <h1 class="sub-header">Бонусы</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    <tr>
                        <th>Пользователь</th>
                        <th>Сумма</th>
                        <th>Дата</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($list as $item)
                        <tr>
                            <td>{{ $item->users['login'] }}</td>
                            <td>{{ $item->value }}₽</td>
                            <td>{{ isset($item->time) ? \Carbon\Carbon::parse($item->time)->format("d.m.Y H:i") : "" }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="3">Нет записей</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 text-center">
            {{ $list->links() }}
        </div>
    </div>


@endsection

@push('footer-scripts')
@endpush
