@extends('user')

@section('content')
    @include('alerts')

    <h1 class="page-header">Сообщения</h1>
    <div id="exTab2" class="">
        <ul class="nav nav-tabs">
            <li class="active">
                <a  href="#incoming" data-toggle="tab">Входящие</a>
            </li>
            <li><a href="#read" data-toggle="tab">Прочитаные</a>
            </li>
            <li><a href="#unread" data-toggle="tab">Непрочитанные</a>
            </li>
            <li><a href="#write" data-toggle="tab">Написать</a>
            </li>
        </ul>

        <div class="tab-content ">
            <div class="tab-pane active" id="incoming">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Отправитель</th>
                            <th>Сообщение</th>
                            <th>Дата получения</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($messages as $message)
                            <tr>
                                <td>{{ $message->from_user }}</td>
                                <td>{{ $message->message }}</td>
                                <td>{{ $message->created_at}}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">Нет сообщений</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="tab-pane" id="read">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Отправитель</th>
                        <th>Сообщение</th>
                        <th>Дата получения</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($messages as $message)
                        @if($message->is_read != 1)
                            @continue
                        @endif
                        <tr>
                            <td>{{ $message->from_user }}</td>
                            <td>{{ $message->message }}</td>
                            <td>{{ $message->created_at}}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">Нет сообщений</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="tab-pane" id="unread">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Отправитель</th>
                        <th>Сообщение</th>
                        <th>Дата получения</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($messages as $message)
                        @if($message->is_read != 0)
                            @continue
                        @endif
                        <tr>
                            <td>{{ $message->from_user }}</td>
                            <td>{{ $message->message }}</td>
                            <td>{{ $message->created_at}}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">Нет сообщений</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="tab-pane" id="write">
                Написать
            </div>
        </div>
    </div>
    <div id="dialog_list">
        <!--@include('cabinet.mail.dialogs') -->
    </div>

@endsection
