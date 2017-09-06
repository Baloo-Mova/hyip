@extends('Admin::index')

@section('content')
    @include('Admin::alerts')

    <div>
        <a href='{{ route('admin.faq.add') }}' class="btn-sm btn-primary pull-right">
            <i class="fa fa-plus-square" aria-hidden="true"></i>
            Add
        </a>
        <h1 class="sub-header">FAQ</h1>
    </div>

    @if (count($items))
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>question</th>
                        <th>Published</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                        <tr class="item-{{ $item->id }}">
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->question }}</td>
                            <td>{{ $item->is_active ? 'yes' : 'no' }}</td>
                            <td>
                                <a href='{{ route('admin.faq.get', ['id' => $item->id]) }}'><i class="fa fa-pencil" aria-hidden="true"></i></a>
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
        <div>No faq</div>
    @endif
@endsection

@push('footer-scripts')
<script type="text/javascript">
    var deleteItem = function( id ) {
        if( typeof(id) != 'undefined' && id != '' && confirm('Delete a social faq?') ) {
            document.location.href = "/admin/faq/delete/" + id;
        }
    };
</script>
@endpush
