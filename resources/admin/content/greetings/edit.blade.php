@extends('Admin::index')

@section('content')
    @include('Admin::alerts')

    <div>
        <a href="{{ route('admin.greetings.index') }}" class="btn-sm btn-primary pull-right">
            <i class="fa fa-arrow-left" aria-hidden="true"></i>
            &nbsp;&nbsp;
            back to list
        </a>
        <h3 class="sub-header">
            @if( empty($item->id) )
                Create Greetings
            @else
                Edit Greetings
            @endif
        </h3>
    </div>

    <form action="{{ empty($item->id) ? route('admin.social-networks.save') : route('admin.social-networks.edit.save', ['id' => $item->id]) }}" method="post">

        {{ csrf_field() }}

        <div class="row">
            <div class="col-xs-12 col-md-4">
                <div class="form-group @if( is_error('name') )has-error @endif">
                    <label for="name">Main title</label>
                    <input type="text"
                           name="name"
                           value="{{ !empty($item->name) ? $item->name : '' }}"
                           id="name"
                           class="form-control"
                           maxlength="255"
                           required
                    >
                    @if( is_error('name') )
                        <span class="help-block">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="form-group @if( is_error('name') )has-error @endif">
                    <label for="name">Subtitle</label>
                    <input type="text"
                           name="name"
                           value="{{ !empty($item->name) ? $item->name : '' }}"
                           id="name"
                           class="form-control"
                           maxlength="255"
                           required
                    >
                    @if( is_error('name') )
                        <span class="help-block">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="form-group @if( is_error('name') )has-error @endif">
                    <label for="name">Text</label>
                    <textarea name="" id="" cols="30" rows="10" class="form-control"></textarea>
                    @if( is_error('name') )
                        <span class="help-block">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="form-group @if( is_error('name') )has-error @endif">
                    <label for="name">Image</label>
                    <input type="file">
                    @if( is_error('name') )
                        <span class="help-block">{{ $errors->first('name') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-main-carousel btn-flat ">{{ empty($item->id) ? "Create" : "Edit" }}</button>
                </div>
            </div>


        </div>

    </form>

@endsection
