@extends('Admin::index')

@section('content')
    @include('Admin::alerts')

    <div>
        <a href='{{ route('admin-add-subscription') }}' class="btn-sm btn-primary pull-right">
            <i class="fa fa-plus-square" aria-hidden="true"></i>
            Добавить
        </a>
        <h1 class="sub-header">Тарифы</h1>
    </div>

    @if (count($items))
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Название</th>
                        <th>Цена</th>
                        <th>Срок действия</th>
                        <th>Включен</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                        <tr class="item-{{ $item->id }}">
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->price }}₽</td>
                            <td>{{ $item->term }}</td>
                            <td>{{ $item->is_active ? 'да' : 'нет' }}</td>
                            <td>
                                <a href='{{ route('admin-get-subscription', ['id' => $item->id]) }}'><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                &nbsp;&nbsp;&nbsp;
                                @if($item->is_active == 1)
                                <a href='{{ route('admin.subscription.disable', ['id' => $item->id]) }}' title="Выключить тариф"><i class="fa fa-stop" aria-hidden="true"></i></a>
                                &nbsp;&nbsp;&nbsp;
                                @else
                                <a href='{{ route('admin.subscription.enable', ['id' => $item->id]) }}' title="Включить тариф"><i class="fa fa-play" aria-hidden="true"></i></a>
                                    &nbsp;&nbsp;&nbsp;
                                @endif
                                <a onclick="deleteSubscription('{{ $item->id }}')" style="cursor: pointer;"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pull-right">
                {{ $items->render() }}
            </div>
        </div>
    @else
        <div>Нет тарифов</div>
    @endif

@push('footer-scripts')
    <script type="text/javascript">
        var deleteSubscription = function( id ) {
            if( typeof(id) != 'undefined' && id != '' && confirm('Delete a subscription?') ) {
                document.location.href = "/admin/subscriptions/delete/" + id;
            }
        };
    </script>
@endpush
@endsection