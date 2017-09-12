@if($errors->count() > 0)
    @foreach($errors->all() as $message)
        <div class="alert alert-danger alert-dismissable btn-flat">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <p>{{$message}}</p>
        </div>
    @endforeach
@endif
@if (Session::has('messages'))
    @foreach (Session::get('messages') as $message)
        <div class="alert alert-success btn-flat">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <p>{{ $message }}</p>
        </div>
    @endforeach
@endif