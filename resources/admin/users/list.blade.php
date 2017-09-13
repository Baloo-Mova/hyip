@extends('Admin::index')

@section('content')
    @include('Admin::alerts')

    <div>
        <h1 class="sub-header">Users</h1>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Id</th>
                <th>Email</th>
                <th>Login</th>
                <th>Balance</th>
                <th>Referrals Count</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->login}}</td>
                    <td>{{$user->balance}}</td>
                    <td>{{$user->ref_count}}</td>
                    <td>
                        <a title="Edit" href="{{route('admin-users-edit', ['id'=>$user->id])}}"><i
                                    class="fa fa-edit"></i></a>
                        <a title="BAN or UNBAN"
                           href="{{route('admin-users-ban', ['id'=>$user->id,'type'=>$user->is_banned==0?1:0])}}"><i
                                    class="fa {{ $user->is_banned == 1?'fa-unlock green':'fa-lock red'}} "></i></a>
                        <a title="Delete" href="{{route('admin-users-delete', ['id'=>$user->id])}}"><i
                                    class="fa fa-trash"></i></a>
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