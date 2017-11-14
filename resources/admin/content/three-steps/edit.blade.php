@extends('Admin::index')

@section('content')
    @include('Admin::alerts')

    <div>
        <h3 class="sub-header">
            Текст 3 шага
        </h3>
    </div>

    <form action="{{ empty($item->id) ? route('admin.three-steps.save') : route('admin.three-steps.save.edit', ['id' => $item->id]) }}" method="post" enctype="multipart/form-data">

        {{ csrf_field() }}

        @if(isset($item->id))
            <input type="hidden" name="id" value="{{ $item->id }}">
        @endif

        <div class="row">
            <div class="col-xs-12 col-md-4">
                <div class="form-group @if( is_error('input_title') )has-error @endif">
                    <label for="main_title">Заголовок</label>
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
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-md-4">
                <div class="form-group @if( is_error('first_img') )has-error @endif">
                    <label for="file">Первая картинка</label>
                    <br>
                    @if(isset($item) && isset($item->first_img))
                        <img src="{{ route('get.image', ['type' => 'three_steps', 'name' => $item->first_img]) }}" alt="" style="width: 100px;">
                        <input type="hidden" name="first_img" value="{{ $item->first_img }}">
                        <br>
                        <a href="{{ route('admin.three-steps.delete.image', ['id' => $item->id, 'field' => 1]) }}" class="btn btn-primary mt10">Удалить</a>
                    @else
                        <input type="file" name="first_img">
                    @endif
                    @if( is_error('first_img') )
                        <span class="help-block">{{ $errors->first('first_img') }}</span>
                    @endif
                </div>
                <div class="form-group @if( is_error('first_title') )has-error @endif">
                    <label for="first_title">Первый заголовк</label>
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
                    <label for="first_text">Первый текст</label>
                    <textarea name="first_text" id="first_text" class="form-control" rows="10">{{ !empty($item->first_text) ? $item->first_text : '' }}</textarea>
                    @if( is_error('first_text') )
                        <span class="help-block">{{ $errors->first('first_text') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-xs-12 col-md-4">
                <div class="form-group @if( is_error('second_img') )has-error @endif">
                    <label for="file">Вторая картинка</label>
                    <br>
                    @if(isset($item) && isset($item->second_img))
                        <img src="{{ route('get.image', ['type' => 'three_steps', 'name' => $item->second_img]) }}" alt="" style="width: 100px;">
                        <input type="hidden" name="second_img" value="{{ $item->second_img }}">
                        <br>
                        <a href="{{ route('admin.three-steps.delete.image', ['id' => $item->id, 'field' => 2]) }}" class="btn btn-primary mt10">Удалить</a>
                    @else
                        <input type="file" name="second_img">
                    @endif
                    @if( is_error('second_img') )
                        <span class="help-block">{{ $errors->first('second_img') }}</span>
                    @endif
                </div>
                <div class="form-group @if( is_error('second_title') )has-error @endif">
                    <label for="second_title">Второй заголовок</label>
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
                    <label for="second_text">Второй текст</label>
                    <textarea name="second_text" id="second_text" class="form-control" rows="10">{{ !empty($item->second_text) ? $item->second_text : '' }}</textarea>
                    @if( is_error('second_text') )
                        <span class="help-block">{{ $errors->first('second_text') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-xs-12 col-md-4">
                <div class="form-group @if( is_error('third_img') )has-error @endif">
                    <label for="file">Третья картинка</label>
                    <br>
                    @if(isset($item) && isset($item->third_img))
                        <img src="{{ route('get.image', ['type' => 'three_steps', 'name' => $item->third_img]) }}" alt="" style="width: 100px;">
                        <input type="hidden" name="third_img" value="{{ $item->third_img }}">
                        <br>
                        <a href="{{ route('admin.three-steps.delete.image', ['id' => $item->id, 'field' => 3]) }}" class="btn btn-primary mt10">Удалить</a>
                    @else
                        <input type="file" name="third_img">
                    @endif
                    @if( is_error('third_img') )
                        <span class="help-block">{{ $errors->first('third_img') }}</span>
                    @endif
                </div>
                <div class="form-group @if( is_error('third_title') )has-error @endif">
                    <label for="third_title">Третий заголовк</label>
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
                    <label for="third_text">Третий текст</label>
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
                    <button type="submit" class="btn btn-main-carousel btn-flat ">Сохранить</button>
                </div>
            </div>
        </div>

    </form>

@endsection
