@extends('user')

@section('content')
    @include('alerts')




    <h1 class="page-header">Рефералы</h1>

    @if(count($referrals))
        <table class="table table-striped">
            <thead>
            <tr>
                <th>ID пользователя</th>
                <th>Логин</th>
                <th>Дата регистрации</th>
                <th>Принес</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($referrals as $referral)
                <tr>
                    <td>{{ $referral->id }}</td>
                    <td>{{ $referral->user_ref_name }}</td>
                    <td>{{ $referral->created_at }}</td>
                    <td>{{ $referral->earned }}</td>
                    <td><a href="/cabinet/dialogs/{{ $referral['id'] }}">Отправить сообщение</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <div>Нет рефералов</div>
    @endif
@endsection