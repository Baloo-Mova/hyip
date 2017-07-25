@extends('index')

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
        <h2 class="form-signin-heading">Cabinet</h2>

@endsection