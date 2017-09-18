@extends('user')

@section('content')
    @include('alerts')

    <div class="row">
        <div class="col-xs-12">
            <h1 class="page-header">Сообщения</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-md-4">
            <div class="news__item input-budjet__wrap">
                <div class="input-budjet__header">
                    <h4>Найти пользователя</h4>
                </div>
                <div class="input-budjet__body">
                    <select name="user_select" class="user_select" id="">

                    </select>
                    <br>
                    <button type="submit" class="btn btn-main-carousel btn-flat mt20 open_chat">Открыть чат</button>
                </div>
            </div>
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
                            <a href="{{ route('chat', ['my_id' => $message->to_user, 'you_id' => $message->from_user]) }}">
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

@section('js')
    <script>
        $("document").ready(function () {

            $(".open_chat").on("click", function (e) {
                var to_user = $(".user_select").val();
                $(location).attr('href', "{{ url('/cabinet/chat') }}/" + "{{ \Auth::user()->id }}" + "/" + to_user);
            });

            var userselect = $(".user_select").select2({
                allowClear: true,
                placeholder: "Выберите пользователя",
                minimumInputLength: 3,
                ajax: {
                    url: "{{ route('dialogs.get.user') }}",
                    dataType: 'json',
                    delay: 500,
                    data: function (term, page) { // page is the one-based page number tracked by Select2
                        return {
                            email: term,
                            page: page // page number
                        };
                    },
                    processResults: function (data, params) {
                        params.page = params.page || 1;
                        return {
                            results: data,
                            pagination: {
                                more: data.length == 10
                            }
                        };
                    },
                },
            });
        });
    </script>
@stop
