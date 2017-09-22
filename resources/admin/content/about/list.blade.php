@extends('Admin::index')

@section('content')
    @include('Admin::alerts')

    <div>
    <a href='{{ route('admin.about-notations.add') }}' class="btn-sm btn-primary pull-right">
        <i class="fa fa-plus-square" aria-hidden="true"></i>
        Add
    </a>
    <h1 class="sub-header">О компании</h1>
    </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <form action="" method="get">
                            <th></th>
                            <th class="w200">
                                <select name="lang" class="form-control" id="lang">
                                    <option value="all" {{ isset($lang) && $lang == "all" ? "selected" : "" }}>All languages</option>
                                    @foreach(config('languages') as $key=>$item)
                                        <option value="{{ $key }}" {{ isset($lang) && $lang == $key ? "selected" : "" }}>{{ $item }}</option>
                                    @endforeach
                                </select>
                            </th>
                            <th></th>
                            <th>
                                <button type="submit" class="btn btn-primary">Select</button>
                            </th>
                        </form>
                    </tr>
                    <tr>
                        <th>Title</th>
                        <th>Language</th>
                        <th>Published</th>
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
                            <td>{{ $item->is_active ? 'yes' : 'no' }}</td>
                            <td>
                                <a href='{{ route('admin.about-notations.get', ['id' => $item->id]) }}'><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                &nbsp;&nbsp;&nbsp;
                                <a onclick="deleteItem('{{ $item->id }}')" style="cursor: pointer;"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="4">
                                No items
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="pull-right">
                {{ $items->render() }}
            </div>
        </div>

@endsection

@push('footer-scripts')
    <script type="text/javascript">
        var deleteItem = function( id ) {
            if( typeof(id) != 'undefined' && id != '' && confirm('Delete a about notation?') ) {
                document.location.href = "/admin/about/delete/" + id;
            }
        };
    </script>
@endpush
