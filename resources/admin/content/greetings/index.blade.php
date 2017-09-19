@extends('Admin::index')

@section('content')
    @include('Admin::alerts')
    <div>
        <a href='{{ route('admin.greetings.create') }}' class="btn-sm btn-primary pull-right">
            <i class="fa fa-plus-square" aria-hidden="true"></i>
            Add
        </a>
        <h1 class="sub-header">Greetings</h1>
    </div>


        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Main title</th>
                    <th>Lang</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    @if (count($list))
                        @foreach($list as $item)
                            <tr>
                                <td>{{ $item->main_title }}</td>
                                <td>{{ $item->lang }}</td>
                                <td>
                                    <a href='{{ route('admin.social-networks.get', ['id' => $item->id]) }}'><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    &nbsp;&nbsp;&nbsp;
                                    <a href="{{ route('admin.social-networks.delete', ['id' => $item->id]) }}" onclick="return confirm('Delete this item?')" style="cursor: pointer;"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td class="text-center" colspan="3">No items</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
@endsection

@push('footer-scripts')
@endpush
