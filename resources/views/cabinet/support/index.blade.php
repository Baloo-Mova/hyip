@extends('user')

@section('content')
    @include('alerts')
    <div class="row">
        <div class="col-xs-12">
            <h1 class="page-header">Поддержка</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-4">
            <div class="news__item input-budjet__wrap">
                <div class="input-budjet__header">
                    <h4>Обратиться в техподдержку</h4>
                </div>
                <div class="input-budjet__body">
                    <form action="{{ route('create-feedback') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" class="form-control btn-flat" name="name" id="name" value="{{ $user->login }}">
                        <input type="hidden" class="form-control btn-flat" name="email" id="email" value="{{ $user->email }}">
                        <div class="form-group">
                            <label for="question">Вопрос</label>
                            <textarea name="question" id="question" class="form-control contacts__textarea btn-flat"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-main-carousel btn-flat">Отправить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Вопрос</th>
                        <th>Ответ</th>
                        <th>Статус</th>
                        <th>Дата</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @forelse($feedbacks as $feedback)
                    <tr>
                        <td>{{ mb_substr($feedback->question, 0, 80)  }}</td>
                        <td>{{ isset($feedback->answer) ? mb_substr($feedback->answer, 0, 80) : "-"  }}</td>
                        <td>{{ $feedback->is_reply == 0 ? "Новый" : "Прочтен"  }}</td>
                        <td>{{ \Carbon\Carbon::parse($feedback->created_at)->format("d.m.Y h:i")  }}</td>
                        <td>
                            <a href="{{ route('support.show', ['id' => $feedback->id]) }}">
                                <i class="fa phpdebugbar-fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">
                            Нет запросов
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="col-xs-12">
            {{ $feedbacks->links() }}
        </div>
    </div>


@endsection