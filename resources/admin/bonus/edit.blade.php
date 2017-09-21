@extends('Admin::index')

@section('content')
    @include('Admin::alerts')

    <div>
        <a href="{{ route('admin.bonus.index') }}" class="btn-sm btn-primary pull-right">
            <i class="fa fa-arrow-left" aria-hidden="true"></i>
            &nbsp;&nbsp;
            назад
        </a>
        <h3 class="sub-header">
            Выдать бонус
        </h3>
    </div>

    <form action="" method="post">

        {{ csrf_field() }}

        <div class="row">
            <div class="col-xs-12 col-md-4">
                <div class="bonus_item">
                    <div class="form-group">
                        <label for="bonus_type1">
                            <input type="radio" id="bonus_type1" name="bonus_type"> Пользователям из списка
                        </label>
                    </div>
                    <div class="form-group @if( is_error('user') )has-error @endif">
                        <label for="user">Пользователь</label>
                        <select class="user_select" name="user" id="user">

                        </select>
                        @if( is_error('user') )
                            <span class="help-block">{{ $errors->first('user') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="all_users">
                            <input type="checkbox" id="all_users" name="all_users"> Всем пользователям
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-4">
                <div class="bonus_item">
                    <div class="form-group">
                        <label for="bonus_type3">
                            <input type="radio" id="bonus_type3" name="bonus_type"> За период
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="period">Период</label>
                        <input type="text" id="period" class="form-control btn-flat input_user_select date_range" name="period">
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-4">
                <div class="bonus_item">
                    <div class="form-group">
                        <label for="bonus_type4">
                            <input type="radio" id="bonus_type4" name="bonus_type"> Оплатившим подписку
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="bonus_type4">
                            <label for="tariff">Подписка</label>
                            <select name="tariff" id="tariff">

                            </select>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-md-4">
                <div class="form-group @if( is_error('amount') )has-error @endif">
                    <label for="amount">Сумма ₽</label>
                    <input type="text"
                           name="amount"
                           id="amount"
                           class="form-control"
                           required
                    >
                    @if( is_error('amount') )
                        <span class="help-block">{{ $errors->first('amount') }}</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-md-4">
                <div class="form-group @if( is_error('amount') )has-error @endif">
                    <label for="comment">Комментарий</label>
                    <textarea name="comment" id="comment" class="form-control" rows="6"></textarea>
                    @if( is_error('comment') )
                        <span class="help-block">{{ $errors->first('comment') }}</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div class="form-group">
                    <button type="submit" class="btn btn-main-carousel btn-flat ">Отправить</button>
                </div>
            </div>
        </div>

    </form>

@stop

@section('js')
    <script>
        $("document").ready(function () {

            var userselect = $(".user_select").select2({
                allowClear: true,
                placeholder: "{{ __("messages.select_user") }}",
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
