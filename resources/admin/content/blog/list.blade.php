@extends('Admin::index')

@section('content')
    @include('Admin::alerts')

    <div>
    <a href='{{ route('admin.articles.add') }}' class="btn-sm btn-primary pull-right">
        <i class="fa fa-plus-square" aria-hidden="true"></i>
        Add
    </a>
    <h1 class="sub-header">Articles</h1>
    </div>

    @if (count($items))
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Published</th>
                        <th>Type</th>
                        <th>Date</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                        <tr class="item-{{ $item->id }}">
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->published ? 'yes' : 'no' }}</td>
                            <td>{{ $item->type_id == 1 ? 'Blog' : 'Stock' }}</td>
                            <td>{{ $item->created_at->format('d.m.Y H:i:s') }}</td>
                            <td>
                                <a href='{{ route('admin.articles.get', ['id' => $item->id]) }}'><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                &nbsp;&nbsp;&nbsp;
                                <a onclick="deleteNews('{{ $item->id }}')" style="cursor: pointer;"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pull-right">
                {{ $items->render() }}
            </div>
        </div>
    @else
        <div>No articles</div>
    @endif

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