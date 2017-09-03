@extends('Admin::index')

@section('content')
    @include('Admin::alerts')

    <div>
        <h1 class="sub-header">Sending messages</h1>
    </div>

    <div class="row">
        {!! Form::open(['class' => 'form']) !!}

            <div class="col-xs-12">
                <div class="form-group @if( is_error('text') )has-error @endif">
                    {!! Form::label('text', '* Message') !!}
                    {!! Form::textarea('text', '', ['id' => 'text', 'rows' => '4', 'class' => 'form-control', 'required' => 'required' ]) !!}
                    @if( is_error('text') )
                        <span class="help-block">{{ $errors->first('name') }}</span>
                    @endif
                </div>
            </div>

            <div class="col-xs-12">
                <div class="radio">
                    <label>
                        {!! Form::radio('type', 1, 1) !!}
                        Internal messages
                    </label>
                </div>
                <div class="radio">
                    <label>
                        {!! Form::radio('type', 2, 0) !!}
                        External messages
                    </label>
                </div>
            </div>

            <div class="col-md-12" style="margin-top: 25px;">
                {!! Form::customButton('Send', 'btn btn-primary', 'fa-envelope-o') !!}
            </div>

        {!! Form::close() !!}
    </div>

@endsection