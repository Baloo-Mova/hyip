@extends('user')

@section('content')
    @include('alerts')
    <h1 class="page-header">Ввод/вывод </h1>
    <div id="exTab2" class="">
        <ul class="nav nav-tabs">
            <li class="{{ $type == "input" ? "active" : "" }}">
                <a href="#in" data-toggle="tab">Пополнить счет</a>
            </li>
            <li class="{{ $type == "output" ? "active" : "" }}">
                <a href="#out" data-toggle="tab">Вывести средства</a>
            </li>
        </ul>

        <div class="tab-content ">
            {{-- 1-st tab --}}
            <div class="tab-pane {{ $type == "input" ? "active" : "" }} row" id="in">
                <div class="col-md-4 col-xs-12">
                    <div class="news__item input-budjet__wrap">
                        <div class="input-budjet__header">
                            <h2>{{ isset($item) ? $item->input_title : "Пополнить счет" }}</h2>
                        </div>
                        <div class="input-budjet__body">
                            <form action="{{route('facilities.refill')}}" method="POST">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="sum">
                                        Сумма пополения:
                                    </label>
                                    <input type="number" name="count" class="form-control btn-flat" placeholder="500₽">
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-main-carousel btn-md btn-flat">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-xs-12">
                    <div class="news__item input-budjet__wrap p20">
                        <label for="">Как пополнить счет:</label>
                        <p>{!! isset($item) ? $item->input_text : "" !!}</p>
                    </div>
                </div>
            </div>
            {{-- 1-st tab --}}

            <div class="tab-pane {{ $type == "output" ? "active" : "" }}" id="out">
                <div class="col-md-4 col-xs-12">
                    <div class="news__item input-budjet__wrap">
                        <div class="input-budjet__header">
                            <h2>{{ isset($item) ? $item->output_title : "Вывести средства" }}</h2>
                        </div>
                        <div class="input-budjet__body">
                            <form action="{{route('facilities.withdraw')}}" method="POST">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="sum">
                                        Сумма вывода:
                                    </label>
                                    <input type="number" name="sum" id="sum"
                                           class="form-control btn-flat @if( is_error('sum') )has-error @endif" min="{{ config('payment.min_sum') }}" max="{{ \Auth::user()->balance }}" placeholder="500₽">
                                    @if( is_error('sum') )
                                        <span class="help-block">{{ $errors->first('sum') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="pay_system">
                                        Система вывода:
                                    </label>
                                    <select name="pay_system" id="pay_system" class="pay_system form-control btn-flat @if( is_error('pay_system') )has-error @endif">
                                        @if(isset($pay_systems))
                                            <option disabled selected>Выберите систему</option>
                                        @endif
                                        @forelse($pay_systems as $system)
                                            @if(mb_strtolower($system['name']) == 'bitcoin')
                                                @continue
                                            @endif
                                            <option value="{{ $system['id'] }}">{{ $system['name'] }}</option>
                                        @empty
                                            <option disabled selected>Список систем пуст</option>
                                        @endforelse
                                    </select>
                                    @if( is_error('pay_system') )
                                        <span class="help-block">{{ $errors->first('pay_system') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="card_number">
                                        Куда вывести:
                                    </label>
                                    <input type="text" name="card_number"
                                           class="form-control form-control btn-flat @if( is_error('card_number') )has-error @endif">
                                    @if( is_error('card_number') )
                                        <span class="help-block">{{ $errors->first('card_number') }}</span>
                                    @endif
                                </div>
                                <div class="form-group contact_person__wrap">
                                    <label for="card_number">
                                        Имя получателя:
                                    </label>
                                    <input type="text" name="contact_person"
                                           class="form-control form-control btn-flat @if( is_error('contact_person') )has-error @endif">
                                    @if( is_error('contact_person') )
                                        <span class="help-block">{{ $errors->first('contact_person') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-main-carousel btn-md btn-flat" {{ count($pay_systems) == 0 ? "disabled" : "" }}>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-xs-12">
                    <div class="news__item input-budjet__wrap p20">
                        <label for="">Как вывести средства:</label>
                        <p>{!! isset($item) ? $item->output_text : "" !!}</p>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-xs-12">
                     <h4>История операций</h4>
                    <hr>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Тип</th>
                                <th>Сумма</th>
                                <th>Статус</th>
                                <th>Комментарий</th>
                                <th>Дата</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($operations as $operation)
                                <tr>
                                    <td>
                                        {{ $operation->getType->name }}
                                    </td>
                                    <td>
                                        {{ $operation->value }}₽
                                    </td>
                                    <td>
                                        {{ ($operation->status == 0) ? "Новая" : (($operation->status == 1) ? "Выполнено" : "Отказ") }}
                                    </td>
                                    <td>
                                        {{ $operation->comment }}
                                    </td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($operation->time)->format('d.m.Y H:i:s') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">
                                        <p>Нет операций</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt20 text-center">
                        {{ $operations->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $(".pay_system").on("change", function (e) {
                var id = $(this).val();
                e.preventDefault();
                $('#preloader').fadeIn('slow', function () {
                    $(this).show();
                });
                $.ajax({
                    method: "get",
                    url: "{{ url('/cabinet/facilities/get-pay-system-info') }}/" + id,
                    success: function (data) {
                        $('#preloader').fadeOut('slow', function () {
                            $(this).hide();
                        });
                        if (data.success === true) {
                            $(".contact_person__wrap").show();
                        }else{
                            $(".contact_person__wrap").hide();
                        }
                    },
                    dataType: "json"
                });
            });
        });
    </script>
@stop