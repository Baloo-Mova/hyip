@extends('user')

@section('content')
    @include('alerts')

    <h1 class="page-header">Тарифы</h1>

    @if(count($subscriptions))
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Levels</th>
                <th>Price</th>
                <th>Term</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($subscriptions as $key => $subscription)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $subscription->name }}</td>
                    <td>{{ $subscription->levels }}</td>
                    <td>{{ $subscription->price }} руб?</td>
                    <td>{{ $subscription->term }} дней</td>
                    <td><a href="{{ route('tariff.payment', ['id' => $subscription->id]) }}">Оплатить</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <div>Нет рефералов</div>
    @endif
@endsection