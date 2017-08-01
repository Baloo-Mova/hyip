@extends('index')

@section('content')

    <div class="container">
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

        <h2>Dialogs</h2>
        <div id="dialog_list">
            @include('cabinet.mail.dialogs')
        </div>
    </div>

@endsection
