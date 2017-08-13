@extends('Admin::index')

@section('content')
    @include('Admin::alerts')

    <div>
        <a href='{{ route('admin-add-subscription') }}' class="btn-sm btn-primary pull-right">
            <i class="fa fa-plus-square" aria-hidden="true"></i>
            Add
        </a>
        <h1 class="sub-header">Subscriptions</h1>
    </div>

    @if (count($items))
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Term</th>
                        <th>Active</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                        <tr class="item-{{ $item->id }}">
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->price }}</td>
                            <td>{{ $item->term }}</td>
                            <td>{{ $item->is_active ? 'yes' : 'no' }}</td>
                            <td>
                                <a href='{{ route('admin-get-subscription', ['id' => $item->id]) }}'><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                &nbsp;&nbsp;&nbsp;
                                <a onclick="deleteSubscription('{{ $item->id }}')" style="cursor: pointer;"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
        <div>No subscriptions</div>
    @endif

@push('footer-scripts')
    <script type="text/javascript">
        var deleteSubscription = function( id ) {
            if( typeof(id) != 'undefined' && id != '' && confirm('Delete a subscription?') ) {
                document.location.href = "/admin/subscription/delete/" + id;
            }
        };
    </script>
@endpush
@endsection