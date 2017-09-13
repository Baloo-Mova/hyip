@extends('Admin::index')

@section('content')
    @include('Admin::alerts')

    <div>
        <h1 class="sub-header">Edit user by ID: {{$user->id}}</h1>
    </div>
    <div class="col-xs-12 col-lg-6">
        <div class="box">
            <div class="box-header">&nbsp;</div>
            <div class="box-body">
                <form action="{{route('admin-users-update',['id'=>$user->id])}}" method="post">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label>Login</label>
                        <input name="login" value="{{$user->login}}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input name="email" value="{{$user->email}}" type="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input name="phone" value="{{$user->phone}}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <select name="role" class="form-control">
                            @foreach($roles as $state)
                                @if($user->role == $state['id'])
                                    <option value="{{$state['id']}}" selected>{{$state['name']}}</option>
                                @else
                                    <option value="{{$state['id']}}"> {{$state['name']}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Balance</label>
                        <input name="balance" value="{{$user->balance}}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Is Banned</label>
                        <select name="is_banned" class="form-control">
                            @foreach($banState as $state)
                                @if($user->is_banned == $state['id'])
                                    <option value="{{$state['id']}}" selected>{{$state['name']}}</option>
                                @else
                                    <option value="{{$state['id']}}"> {{$state['name']}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>


                    <input type="submit" class="btn btn-primary" value="Update">
                    <a href="{{route('admin-users-list')}}" class="btn btn-default" style="float: right;"> Back</a>
                </form>
            </div>
        </div>
    </div>

@endsection