@extends('Admin::index')

@section('content')
    @if(Session::get('errors'))
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <ul>
                @foreach($errors->all() as $message)
                    <li>{{$message}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session()->has('messages'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <ul>
                @foreach (session()->get('messages') as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div>
        <h1 class="sub-header">Dashboard</h1>
    </div>

    <h3>Users</h3>
    @if (count($users))
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Active</th>
                        <th>Banned</th>
                        <th>All</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $users['active'] }}</td>
                        <td>{{ $users['all_users'] - $users['active'] }}</td>
                        <td>{{ $users['all_users'] }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    @else
        <div>No users</div>
    @endif

    <h3>Subscriptions</h3>
    @if (count($subscriptions))
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Active</th>
                </tr>
                </thead>
                <tbody>
                @foreach($subscriptions as $group)
                    @foreach($group as $subscription)
                        <tr>
                            <td><a href="{{ route('admin-get-subscription', ['id' => $subscription->id]) }}">{{ $subscription->name }}</a></td>
                            <td>{{ $subscription->is_active ? 'Yes' : 'No' }}</td>
                        </tr>
                    @endforeach
                @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div>No subscriptions</div>
    @endif

@endsection