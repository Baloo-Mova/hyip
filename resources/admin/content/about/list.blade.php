@extends('Admin::index')

@section('content')
    @include('Admin::alerts')

    <div>
    <a href='{{ route('admin.about-notations.add') }}' class="btn-sm btn-primary pull-right">
        <i class="fa fa-plus-square" aria-hidden="true"></i>
        Add
    </a>
    <h1 class="sub-header">About notations</h1>
    </div>

    @if (count($items))
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Published</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                        <tr class="item-{{ $item->id }}">
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->published ? 'yes' : 'no' }}</td>
                            <td>
                                <a href='{{ route('admin.about-notations.get', ['id' => $item->id]) }}'><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                &nbsp;&nbsp;&nbsp;
                                <a onclick="deleteItem('{{ $item->id }}')" style="cursor: pointer;"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
        <div>No notations</div>
    @endif

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
