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
                    <th>Дата получения</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @forelse($chats as $chat)
                    <tr>
                        <td>{{ $chat->dialog_user->login }}</td>
                        <td>{{ $chat->created_at}}</td>
                        <td>
                            <a href="{{ route('chat', ['id' => $chat->id]) }}">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Вы еще ни с кем не общались</td>
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
                $(location).attr('href', "{{ url('/cabinet/dialogs/create-chat') }}/" + to_user);
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
