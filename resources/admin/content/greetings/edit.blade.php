@extends('Admin::index')

@section('content')
    @include('Admin::alerts')

    <div>
        <a href="{{ route('admin.greetings.index') }}" class="btn-sm btn-primary pull-right">
            <i class="fa fa-arrow-left" aria-hidden="true"></i>
            &nbsp;&nbsp;
            назад
        </a>
        <h3 class="sub-header">
            @if( empty($item->id) )
                Создать преимущество
            @else
                Редактировать преимущество
            @endif
        </h3>
    </div>

    <form action="{{ empty($item->id) ? route('admin.greetings.save') : route('admin.greetings.save.edit', ['id' => $item->id]) }}"
          method="post" enctype="multipart/form-data">

        {{ csrf_field() }}

        @if(isset($item->id))
            <input type="hidden" name="id" value="{{ $item->id }}">
        @endif

        <div class="row">
            <div class="col-xs-12 col-md-4">
                <div class="form-group @if( is_error('main_title') )has-error @endif">
                    <label for="main_title">Заголовок</label>
                    <input type="text"
                           name="main_title"
                           value="{{ !empty($item->main_title) ? $item->main_title : '' }}"
                           id="main_title"
                           class="form-control"
                           maxlength="255"
                           required
                    >
                    @if( is_error('main_title') )
                        <span class="help-block">{{ $errors->first('main_title') }}</span>
                    @endif
                </div>
                <div class="form-group @if( is_error('image') )has-error @endif">
                    <label for="image">Картинка</label>
                    <br>
                    @if(isset($item) && isset($item->image))
                        <img src="{{ route('get.image', ['type' => 'greetings', 'name' => $item->image]) }}" alt=""
                             style="width: 100px;">
                        <input type="hidden" name="image" value="{{ $item->image }}">
                        <br>
                        <a href="{{ route('admin.greetings.delete.img', ['id' => $item->id]) }}"
                           class="btn btn-primary mt10">Delete</a>
                    @else
                        <input type="file" name="image">
                    @endif
                    @if( is_error('image') )
                        <span class="help-block">{{ $errors->first('image') }}</span>
                    @endif
                </div>
                <div class="form-group @if( is_error('sub_title') )has-error @endif">
                    <label for="sub_title">Подзаголовк</label>
                    <input type="text"
                           name="sub_title"
                           value="{{ !empty($item->sub_title) ? $item->sub_title : '' }}"
                           id="sub_title"
                           class="form-control"
                           maxlength="255"
                           required
                    >
                    @if( is_error('sub_title') )
                        <span class="help-block">{{ $errors->first('sub_title') }}</span>
                    @endif
                </div>
                <div class="form-group @if( is_error('description') )has-error @endif">
                    <label for="description">Текст</label>
                    <textarea name="description" id="description" cols="30" rows="10"
                              class="form-control">{{ !empty($item->description) ? $item->description : '' }}</textarea>
                    @if( is_error('description') )
                        <span class="help-block">{{ $errors->first('description') }}</span>
                    @endif
                </div>
                <div class="form-group @if( is_error('lang') )has-error @endif">
                    <label for="lang">Язык</label>
                    <select name="lang" class="form-control" id="lang">
                        <option disabled {{ !empty($item) ? "" : "selected" }}>Выберите язык</option>
                        @foreach(config('languages') as $key=>$lang)
                            <option value="{{ $key }}" {{ !empty($item->lang) && $item->lang == $key  ? "selected" : "" }}>{{ $lang }}</option>
                        @endforeach
                    </select>
                    @if( is_error('lang') )
                        <span class="help-block">{{ $errors->first('lang') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit"
                            class="btn btn-main-carousel btn-flat ">{{ empty($item->id) ? "Создать" : "Редактировать" }}</button>
                </div>
            </div>


        </div>

    </form>

@endsection
