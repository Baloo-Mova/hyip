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
@if (Session::has('messages'))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <ul>
            @foreach (Session::get('messages') as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
    </div>
@endif