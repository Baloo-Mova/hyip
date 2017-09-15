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
                                    <input type="number" name="count" class="form-control btn-flat" placeholder="500">
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
                    <h2>{{ isset($item) ? $item->output_title : "Вывести средства" }}</h2>
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
                                        {{ $operation->value }}
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