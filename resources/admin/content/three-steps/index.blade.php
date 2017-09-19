@extends('Admin::index')

@section('content')
    @include('Admin::alerts')

    <div>
        <h3 class="sub-header">
            Three steps text
        </h3>
    </div>

    <form action="" method="post">

        {{ csrf_field() }}

        <div class="row">
            <div class="col-xs-12 col-md-4">
                <div class="form-group @if( is_error('input_title') )has-error @endif">
                    <label for="main_title">Main title</label>
                    <input type="text"
                           name="main_title"
                           value="{{ !empty($item->main_title) ? $item->main_title : '' }}"
                           id="main_title"
                           class="form-control"
                           required
                    >
                    @if( is_error('main_title') )
                        <span class="help-block">{{ $errors->first('main_title') }}</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-md-4">
                <div class="form-group @if( is_error('first_title') )has-error @endif">
                    <label for="first_title">First title</label>
                    <input type="text"
                           name="first_title"
                           value="{{ !empty($item->first_title) ? $item->first_title : '' }}"
                           id="first_title"
                           class="form-control"
                           required
                    >
                    @if( is_error('first_title') )
                        <span class="help-block">{{ $errors->first('first_title') }}</span>
                    @endif
                </div>
                <div class="form-group @if( is_error('first_text') )has-error @endif">
                    <label for="first_text">First text</label>
                    <textarea name="first_text" id="first_text" class="form-control" rows="10">{{ !empty($item->first_text) ? $item->first_text : '' }}</textarea>
                    @if( is_error('first_text') )
                        <span class="help-block">{{ $errors->first('first_text') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-xs-12 col-md-4">
                <div class="form-group @if( is_error('second_title') )has-error @endif">
                    <label for="second_title">Second title</label>
                    <input type="text"
                           name="second_title"
                           value="{{ !empty($item->second_title) ? $item->second_title : '' }}"
                           id="second_title"
                           class="form-control"
                           required
                    >
                    @if( is_error('second_title') )
                        <span class="help-block">{{ $errors->first('second_title') }}</span>
                    @endif
                </div>
                <div class="form-group @if( is_error('second_text') )has-error @endif">
                    <label for="second_text">Second text</label>
                    <textarea name="second_text" id="second_text" class="form-control" rows="10">{{ !empty($item->second_text) ? $item->second_text : '' }}</textarea>
                    @if( is_error('second_text') )
                        <span class="help-block">{{ $errors->first('second_text') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-xs-12 col-md-4">
                <div class="form-group @if( is_error('third_title') )has-error @endif">
                    <label for="third_title">Third title</label>
                    <input type="text"
                           name="third_title"
                           value="{{ !empty($item->third_title) ? $item->third_title : '' }}"
                           id="third_title"
                           class="form-control"
                           required
                    >
                    @if( is_error('third_title') )
                        <span class="help-block">{{ $errors->first('third_title') }}</span>
                    @endif
                </div>
                <div class="form-group @if( is_error('third_text') )has-error @endif">
                    <label for="third_text">Third text</label>
                    <textarea name="third_text" id="third_text" class="form-control" rows="10">{{ !empty($item->third_text) ? $item->third_text : '' }}</textarea>
                    @if( is_error('third_text') )
                        <span class="help-block">{{ $errors->first('third_text') }}</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div class="form-group">
                    <button type="submit" class="btn btn-main-carousel btn-flat ">Save</button>
                </div>
            </div>
        </div>

    </form>

@endsection
