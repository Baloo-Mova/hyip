@extends('Admin::index')

@section('content')
    @include('Admin::alerts')

        <div>
            <a href="{{ route('admin.regulations.list') }}" class="btn-sm btn-primary pull-right">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
                &nbsp;&nbsp;
                назад
            </a>
            <h3 class="sub-header">
                @if( empty($item->id) )
                    Создать запись
                @else
                    Редактировать запись
                @endif
            </h3>
        </div>

    <div class="row">
        <form method="POST" action="{{ !isset($item) ? route('admin.documents.save') : route('admin.documents.save.edit', ['id' => $item->id]) }}" class="form" enctype="multipart/form-data">

            {{ csrf_field() }}

            @if(isset($item->id))
                <input type="hidden" name="id" value="{{ $item->id }}">
            @endif

            <div class="col-md-12">
                <div class="form-group @if( is_error('title') )has-error @endif">
                    <label for="edit-form-title">* Заголовок</label>
                    <input type="text"
                           name="title"
                           value="{{ isset($item) ? $item->title : ""}}"
                           id="edit-form-title"
                           class="form-control"
                           maxlength="255"
                           required
                    >
                    @if( is_error('title') )
                        <span class="help-block">{{ $errors->first('title') }}</span>
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
                    <label for="edit-form-content">* Текст</label>
                    <textarea name="content"
                              required
                              id="edit-form-content"
                    >{{ isset($item) ? $item->content : ""}}</textarea>
                </div>
                <div class="form-group">
                    <input type="checkbox"
                           name="is_active"
                           value="1"
                           {{ isset($item) ? ($item->is_active == 1 ? 'checked' : '') : "" }}
                           id="edit-form-active">
                    <label for="edit-form-active">Активен</label>
                </div>
            </div>

            <div class="col-md-12" style="margin-top: 25px;">
                <button class="btn btn-primary">
                    <i class="fa fa-floppy-o" aria-hidden="true"></i>
                    &nbsp;&nbsp;
                    Сохранить
                </button>
            </div>

        </form>
    </div>

@endsection


@push('footer-scripts')
<script type="text/javascript" src="/admin-cabinet/plugins/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
    $(function() {
        CKEDITOR.replace('edit-form-content', {contentsCss: "{{ url( elixir('css/ts_main.css') ) }}"});
    });
</script>
@endpush