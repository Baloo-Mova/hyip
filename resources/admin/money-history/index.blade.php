@extends('Admin::index')

@section('content')
    @include('Admin::alerts')

    <div class="row">
        <div class="col-xs-12">
            <a href="{{ route('admin.money.history.index') }}" class="btn btn-flat btn-default pull-right">Сбросить</a>

            <h3 class="sub-header">
                История денежных передвижений
            </h3>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <form action="" method="post">

                            {{ csrf_field() }}

                            <th>
                                <select name="type_id" id="" class="form-control">
                                        <option {{ isset($search['type_id']) ? "" : "selected" }} disabled>Выберите тип</option>
                                    @foreach($types as $type)
                                        <option value="{{ $type->id }}" {{ isset($search['type_id']) && $search['type_id'] == $type->id ? "selected" : "" }}>{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </th>
                            <th></th>
                            <th>
                                <select name="pay_system" id="" class="form-control">
                                    <option {{ isset($search['pay_system']) ? "" : "selected" }} disabled>Выберите систему</option>
                                    @foreach($pay_systems as $system)
                                        <option value="{{ $system['id'] }}"  {{ isset($search['pay_system']) && $search['pay_system'] == $system['id'] ? "selected" : "" }}>{{ $system['name'] }}</option>
                                    @endforeach
                                </select>
                            </th>
                            <th>
                                <input type="text" class="form-control" name="card_number" value="{{ isset($search['card_number']) ? $search['card_number'] : "" }}">
                            </th>
                            <th>
                                <select name="status" id="" class="form-control">
                                    <option {{ isset($search['status']) ? "" : "selected" }} disabled>Выберите статус</option>
                                    <option value="0" {{ isset($search['status']) && $search['status'] == 0 ? "selected" : "" }}>Новая</option>
                                    <option value="1" {{ isset($search['status']) && $search['status'] == 0 ? "selected" : "" }}>Принята</option>
                                    <option value="2" {{ isset($search['status']) && $search['status'] == 0 ? "selected" : "" }}>Отклонена</option>
                                </select>
                            </th>
                            <th>
                                <select class="user_select" name="to_id" id="user">

                                </select>
                            </th>
                            <th>
                                <input type="text" name="time" class="form-control date_range" value="{{ isset($search['time']) ? $search['time'] : "" }}">
                            </th>
                            <th>
                                <button type="submit" class="btn btn-flat btn-primary">Найти</button>
                            </th>
                        </form>
                    </tr>
                    <tr>
                        <th>Тип платежа</th>
                        <th>Сумма</th>
                        <th>Платежная система</th>
                        <th>Счет или карта перевода</th>
                        <th>Статус</th>
                        <th>Пользователь</th>
                        <th colspan="2">Дата</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($history as $item)
                        <tr>
                            <td>{{ $item->getType->name }}</td>
                            <td>{{ $item->value }}₽</td>
                            <td>{{ isset($item->pay_system) ? $pay_systems[$item->pay_system]['name'] : "" }}</td>
                            <td>{{ isset($item->card_number) ? $item->card_number : "" }}</td>
                            <td>{{ ($item->status == 0) ? "Новая" : (($item->status == 1) ? "Принята" : "Отклонена") }}</td>
                            <td>{{ $item->to_id == 0 ? "" : $item->users['login'] }}</td>
                            <td  colspan="2">{{ \Carbon\Carbon::parse($item->time)->format("d.m.Y H:i") }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="8">История пуста!</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 text-center">
            {{ $history->links() }}
        </div>
    </div>

@stop

@section('js')
    <script>
        $("document").ready(function () {

            var userselect = $(".user_select").select2({
                allowClear: true,
                placeholder: "Выберите пользователя",
                minimumInputLength: 3,
                ajax: {
                    url: "{{ route('admin.get.user') }}",
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

            $('.date_range').daterangepicker({
                autoUpdateInput: false,
                locale: {
                    format: 'DD.MM.YYYY'
                }
            });

            $('.date_range').on('apply.daterangepicker', function (ev, picker) {
                $(this).val(picker.startDate.format('DD.MM.YYYY') + ' - ' + picker.endDate.format('DD.MM.YYYY'));
            });

            $('.date_range').on('cancel.daterangepicker', function (ev, picker) {
                $(this).val('');
            });

        });
    </script>
@stop


