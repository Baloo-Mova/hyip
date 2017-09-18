@extends('user')

@section('content')
    @include('alerts')

    <div class="row">
        <div class="col-xs-12">
            <h1 class="page-header">Сообщения</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Отправитель</th>
                    <th>Сообщение</th>
                    <th>Дата получения</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @forelse($messages as $message)
                    <tr>
                        <td>{{ $message->getFromUser->login }}</td>
                        <td>{{ mb_substr($message->message, 0, 80) }}</td>
                        <td>{{ $message->created_at}}</td>
                        <td>
                            <a href="{{ route('chat', ['id' => $message->id]) }}">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Нет сообщений</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
