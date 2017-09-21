@extends('Admin::index')

@section('content')
    @include('Admin::alerts')

    <div>
        <h1 class="sub-header">Черный список</h1>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Логин</th>
                    <th>Email</th>
                    <th>Дата регистрации</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                    <tr class="item-{{ $item->id }}">
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->login }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->created_at->format('d.m.Y H:i:s') }}</td>
                        <td>
                            <a href='{{ route('admin.blacklist.user', ['id' => $item->id]) }}'><i class="fa fa-pencil" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection