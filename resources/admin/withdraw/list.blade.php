@extends('Admin::index')

@section('content')
    @include('Admin::alerts')

    <div>
        <h1 class="sub-header">Withdraws</h1>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th class="w200">
                        <select name="status" id="" class="form-control status">
                            <option value="0" {{ $status == 0 ? "selected" : "" }}>Unread</option>
                            <option value="1" {{ $status == 1 ? "selected" : "" }}>Accepted</option>
                            <option value="2" {{ $status == 2 ? "selected" : "" }}>Declined</option>
                            <option value="3" {{ $status == 3 ? "selected" : "" }}>All</option>
                        </select>
                    </th>
                    <th>
                    </th>
                </tr>
                <tr>
                    <th>Id</th>
                    <th>Value</th>
                    <th>User id</th>
                    <th>Status</th>
                    <th class="tar">Time</th>
                </tr>
            </thead>
            <tbody>
            @foreach($withdraws as $withdraw)
                <tr>
                    <td>{{ $withdraw->id }}</td>
                    <td>{{ $withdraw->value }}₽</td>
                    <td>{{ $withdraw->from_id }}</td>
                    <td>{{ ($withdraw->status == 0) ? "Unread" : (($withdraw->status == 1) ? "Accepted" : "Declined") }}</td>
                    <td class="tar">{{ \Carbon\Carbon::parse($withdraw->time)->format('d.m.Y H:i') }}</td>
                    <td>
                        @if($withdraw->status == 0)
                            <a title="Edit" href="{{ route('admin.withdraws.edit', ['id' => $withdraw->id]) }}"><i
                                        class="fa fa-edit"></i></a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
@section('css')
    <style>
        .red {
            color: red;
        }

        .green {
            color: green;
        }
    </style>
@stop

@section('js')
    <script>
        $(document).ready(function () {
            $(".status").on("change", function (e) {
                var id = $(this).val();
                e.preventDefault();
                $(location).attr('href', "{{ url('/admin/withdraws') }}/" + id);
            });
        });
    </script>
@stop