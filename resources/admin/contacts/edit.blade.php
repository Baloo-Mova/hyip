@extends('Admin::index')

@section('content')
    @include('Admin::alerts')

        <div>
            <a href="{{ route('admin-contacts-list') }}" class="btn-sm btn-primary pull-right">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
                &nbsp;&nbsp;
                back to list
            </a>

            <h3 class="sub-header">
                @if( empty($contact->id) )
                    Create contact
                @else
                    Edit contact
                @endif
            </h3>
        </div>

    <div class="row">
        {!! Form::open(['class' => 'form']) !!}

            <div class="col-xs-12">
                <div class="form-group @if( is_error('name') )has-error @endif">
                    {!! Form::label('edit-form-name', '* Name') !!}
                    {!! Form::text('name', !empty($old_input['name']) ? $old_input['name'] : $contact->name, ['id' => 'edit-form-name', 'class' => 'form-control', 'maxlength' => "255", 'required' => 'required' ]) !!}
                    @if( is_error('name') )
                        <span class="help-block">{{ $errors->first('name') }}</span>
                    @endif
                </div>
            </div>

            <div class="col-xs-12">
                <div class="form-group @if( is_error('value') )has-error @endif">
                    {!! Form::label('edit-form-value', '* Value') !!}
                    {!! Form::text('value', !empty($old_input['value']) ? $old_input['value'] : $contact->value, ['id' => 'edit-form-value', 'class' => 'form-control', 'maxlength' => "255", 'required' => 'required' ]) !!}
                    @if( is_error('value') )
                        <span class="help-block">{{ $errors->first('value') }}</span>
                    @endif
                </div>
            </div>

            <div class="col-md-12" style="margin-top: 25px;">
                {!! Form::customButton('Save', 'btn btn-primary', 'fa-floppy-o') !!}
            </div>

        {!! Form::close() !!}
    </div>

@endsection
