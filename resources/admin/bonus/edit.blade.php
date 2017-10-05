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
                    <div class="form-group @if( is_error('bonus_type') )has-error @endif">
                        <label for="bonus_type1">
                            <input type="radio" class="bonus_item_radio" id="bonus_type1" name="bonus_type" value="1"> Пользователям из списка
                        </label>
                        @if( is_error('user') )
                            <span class="help-block">{{ $errors->first('bonus_type') }}</span>
                        @endif
                    </div>
                    <div class="form-group @if( is_error('user') )has-error @endif">
                        <label for="user">Пользователь</label>
                        <select class="user_select" name="user[]" id="user" multiple="multiple">

                        </select>
                        @if( is_error('user') )
                            <span class="help-block">{{ $errors->first('user') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="all_users">
                            <input type="checkbox" class="all_users" id="all_users" name="all_users"> Всем пользователям
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-4">
                <div class="bonus_item">
                    <div class="form-group @if( is_error('bonus_type') )has-error @endif">
                        <label for="bonus_type3">
                            <input type="radio" class="bonus_item_radio" id="bonus_type3" name="bonus_type" value="2"> По подписке и периоду
                        </label>
                        @if( is_error('user') )
                            <span class="help-block">{{ $errors->first('bonus_type') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="tariff">Подписка</label>
                        <select id="tariff" class="tariff_select" name="tariff[]" multiple="multiple">
                            @foreach($rates as $rate)
                                <option value="{{ $rate->id }}">{{ $rate->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="period">По подписке и периоду</label>
                        <input type="text" id="period" class="form-control btn-flat input_user_select date_range" name="period">
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt20">
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
                <div class="form-group">
                    <label for="comment">Комментарий</label>
                    <textarea name="comment" id="comment" class="form-control" rows="6"></textarea>
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

            $(".user_select").on("change",function () {
               $(".all_users").prop("checked", false);
            });

            $(".bonus_item").on("click", function () {
                var item = $(this).find(".bonus_item_radio");
                $(item).prop("checked", true);
            });

            $(".tariff_select").select2({
                placeholder: "Выберите подписку",
            });

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
