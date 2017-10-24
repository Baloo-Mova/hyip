@extends('Admin::index')

@section('content')
    @include('Admin::alerts')

    <div>
    <a href='{{ route('admin.articles.add') }}' class="btn-sm btn-primary pull-right">
        <i class="fa fa-plus-square" aria-hidden="true"></i>
        Добавить
    </a>
    <h1 class="sub-header">Новости и акции</h1>
    </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Заголовок</th>
                        <th>Язык</th>
                        <th>Активна</th>
                        <th>Тип</th>
                        <th>Дата</th>
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
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>
                                <button type="submit" class="btn btn-primary">Выбрать</button>
                            </th>
                        </form>
                    </tr>
                    <tr>
                        <th>Заголовок</th>
                        <th>Язык</th>
                        <th>Активна</th>
                        <th>Тип</th>
                        <th>Дата</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                        <tr class="item-{{ $item->id }}">
                            <td>{{ $item->title }}</td>
                            <td>
                                <img src="{{ asset('img/flags').'/'.$item->lang.'.svg' }}" alt="" class="countries_flag_header">
                                {{ $item->lang }}
                            </td>
                            <td>{{ $item->published ? 'yes' : 'no' }}</td>
                            <td>{{ $item->type_id == 1 ? 'Blog' : 'Stock' }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d.m.Y H:i:s') }}</td>
                            <td>
                                <a href='{{ route('admin.articles.get', ['id' => $item->id]) }}'><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                &nbsp;&nbsp;&nbsp;
                                <a onclick="deleteNews('{{ $item->id }}')" style="cursor: pointer;"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="6">
                                Нет записей
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="pull-right">
                {{ $items->render() }}
            </div>
        </div>

@push('footer-scripts')
    <script type="text/javascript">
        var deleteNews = function( id ) {
            if( typeof(id) != 'undefined' && id != '' && confirm('Delete a article?') ) {
                document.location.href = "/admin/blog/delete/" + id;
            }
        };
    </script>
@endpush
@endsection