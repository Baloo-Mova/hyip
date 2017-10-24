@extends('Admin::index')

@section('content')
    @include('Admin::alerts')
    <div>
        <a href='{{ route('admin.input-output.create') }}' class="btn-sm btn-primary pull-right">
            <i class="fa fa-plus-square" aria-hidden="true"></i>
            Добавить
        </a>
        <h1 class="sub-header">Ввод/вывод</h1>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Заголовок</th>
                    <th class="w200">Язык</th>
                    <th></th>
                </tr>
                <tr>
                    <form action="" method="get">
                        <th></th>
                        <th class="w200">
                            <select name="lang" class="form-control" id="lang">
                                <option value="all" {{ isset($lang) && $lang == "all" ? "selected" : "" }}>Все языки</option>
                                @foreach(config('languages') as $key=>$item)
                                    <option value="{{ $key }}" {{ isset($lang) && $lang == $key ? "selected" : "" }}>{{ $item }}</option>
                                @endforeach
                            </select>
                        </th>
                        <th>
                            <button type="submit" class="btn btn-primary">Выбрать</button>
                        </th>
                    </form>
                </tr>
                <tr>
                    <th>Заголовок</th>
                    <th class="w200">Язык</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @if (count($list))
                @foreach($list as $item)
                    <tr>
                        <td>{{ $item->input_title }}</td>
                        <td class="w200">
                            <img src="{{ asset('img/flags').'/'.$item->lang.'.svg' }}" alt="" class="countries_flag_header">
                            {{ $item->lang }}
                        </td>
                        <td>
                            <a href='{{ route('admin.input-output.edit', ['id' => $item->id]) }}'><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            &nbsp;&nbsp;&nbsp;
                            <a href="{{ route('admin.input-output.delete', ['id' => $item->id]) }}" onclick="return confirm('Delete this item?')" style="cursor: pointer;"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="text-center" colspan="3">Нет записей</td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-xs-12 text-center">
            {{ $list->links() }}
        </div>
    </div>
@endsection

@push('footer-scripts')
@endpush
