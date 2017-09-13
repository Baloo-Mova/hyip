@extends('Admin::index')

@section('content')
    @include('Admin::alerts')

        <div>
            <a href="{{ route('admin.contacts.list') }}" class="btn-sm btn-primary pull-right">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
                &nbsp;&nbsp;
                back to list
            </a>

            <h3 class="sub-header">
                @if( empty($item->id) )
                    Create contact
                @else
                    Edit contact
                @endif
            </h3>
        </div>

    <div class="row">
        {!! Form::open(['class' => 'form']) !!}

            <div class="col-xs-12 col-md-4">
                <div class="form-group @if( is_error('type_id') )has-error @endif">
                    <label for="type_id">Contact type</label>
                    <select name="type_id" id="type_id" class="form-control">
                        <option disabled {{ !empty($item->type_id) ? "" : "selected" }}>Choose type</option>
                        <option value="1" {{ !empty($item->type_id) && $item->type_id == 1 ? "selected" : "" }}>Email</option>
                        <option value="2" {{ !empty($item->type_id) && $item->type_id == 2 ? "selected" : "" }}>Phone</option>
                    </select>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-xs-12 col-md-4">
                <div class="form-group @if( is_error('value') )has-error @endif">
                    {!! Form::label('edit-form-value', '* Value') !!}
                    {!! Form::text('value', !empty($item->value) ? $item->value : '', ['id' => 'edit-form-value', 'class' => 'form-control', 'maxlength' => "255", 'required' => 'required' ]) !!}
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
