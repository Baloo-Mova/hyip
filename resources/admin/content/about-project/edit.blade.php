@extends('Admin::index')

@section('content')
    @include('Admin::alerts')

    <div>
        <a href="{{ route('admin.about.project.index') }}" class="btn-sm btn-primary pull-right">
            <i class="fa fa-arrow-left" aria-hidden="true"></i>
            &nbsp;&nbsp;
            back to list
        </a>
        <h3 class="sub-header">
            @if( empty($item->id) )
                Create About project text
            @else
                Edit About project text
            @endif
        </h3>
    </div>

    <form action="{{ empty($item->id) ? route('admin.about.project.save') : route('admin.about.project.save.edit', ['id' => $item->id]) }}" method="post" enctype="multipart/form-data">

        {{ csrf_field() }}

        @if(isset($item->id))
            <input type="hidden" name="id" value="{{ $item->id }}">
        @endif

        <div class="row">
            <div class="col-xs-12 col-md-4">
                <div class="form-group @if( is_error('title') )has-error @endif">
                    <label for="title">Title</label>
                    <input type="text"
                           name="title"
                           value="{{ !empty($item->title) ? $item->title : '' }}"
                           id="title"
                           class="form-control"
                           maxlength="255"
                           required
                    >
                    @if( is_error('title') )
                        <span class="help-block">{{ $errors->first('title') }}</span>
                    @endif
                </div>
                <div class="form-group @if( is_error('image') )has-error @endif">
                    <label for="image">Image</label>
                    <br>
                    @if(isset($item) && isset($item->image))
                        <img src="{{ route('get.image', ['type' => 'aboutproject', 'name' => $item->image]) }}" alt="" style="width: 100px;">
                        <input type="hidden" name="image" value="{{ $item->image }}">
                        <br>
                        <a href="{{ route('admin.about.project.delete.img', ['id' => $item->id]) }}" class="btn btn-primary mt10">Delete</a>
                    @else
                        <input type="file" name="image">
                    @endif
                    @if( is_error('image') )
                        <span class="help-block">{{ $errors->first('image') }}</span>
                    @endif
                </div>
                <div class="form-group @if( is_error('description') )has-error @endif">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ !empty($item->description) ? $item->description : '' }}</textarea>
                    @if( is_error('description') )
                        <span class="help-block">{{ $errors->first('description') }}</span>
                    @endif
                </div>
                <div class="form-group @if( is_error('lang') )has-error @endif">
                    <label for="lang">Language</label>
                    <select name="lang" class="form-control" id="lang">
                        <option disabled {{ !empty($item) ? "" : "selected" }}>Choose a language</option>
                        @foreach(config('languages') as $key=>$lang)
                            <option value="{{ $key }}" {{ !empty($item->lang) && $item->lang == $key  ? "selected" : "" }}>{{ $lang }}</option>
                        @endforeach
                    </select>
                    @if( is_error('lang') )
                        <span class="help-block">{{ $errors->first('lang') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-main-carousel btn-flat ">{{ empty($item->id) ? "Create" : "Edit" }}</button>
                </div>
            </div>


        </div>

    </form>

@endsection
