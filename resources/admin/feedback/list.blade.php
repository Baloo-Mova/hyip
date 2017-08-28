@extends('Admin::index')

@section('content')
    @include('Admin::alerts')

    <div>
        <h1 class="sub-header">Feedback</h1>
    </div>

    <div>
        <ul class="nav nav-tabs">
            <li class="@if( preg_match('/^admin\/feedback\/users/i', $current_uri) ) active @endif"><a href='{{ route('admin-feedback-list', ['type' => 'users']) }}'>Пользователи</a></li>
            <li class="@if( preg_match('/^admin\/feedback\/visitors/i', $current_uri) ) active @endif"><a href='{{ route('admin-feedback-list', ['type' => 'visitors']) }}'>Посетители</a></li>
        </ul>


        @if (count($items))
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $item)
                        <tr class="item-{{ $item->id }}">
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->is_read ? $item->is_reply ? 'Is reply' : 'Is read' : 'Is new' }}</td>
                            <td>{{ $item->created_at->format('d.m.Y H:i:s') }}</td>
                            <td>
                                <a href='{{ route('admin-get-feedback', ['type' => str_replace('admin/feedback/', '', $current_uri),'id' => $item->id]) }}'><i class="fa fa-book" aria-hidden="true"></i></a>
                                &nbsp;&nbsp;&nbsp;
                                <a onclick="deleteFeedback('{{ $item->id }}')" style="cursor: pointer;"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
            <div>No feedback</div>
        @endif



    @push('footer-scripts')
        <script type="text/javascript">
            var deleteFeedback = function( id ) {
                if( typeof(id) != 'undefined' && id != '' && confirm('Delete a feedback?') ) {
                    document.location.href = "/admin/feedback/delete/" + id;
                }
            };
        </script>
    @endpush
@endsection