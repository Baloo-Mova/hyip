@extends('Admin::index')

@section('content')
    @include('Admin::alerts')

        <div>
            <a href="{{ route('admin.regulations.list') }}" class="btn-sm btn-primary pull-right">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
                &nbsp;&nbsp;
                back to list
            </a>
            <h3 class="sub-header">
                @if( empty($item->id) )
                    Create regulations
                @else
                    Edit regulations
                @endif
            </h3>
        </div>

    <div class="row">
        <form method="POST" action="{{ empty($item->id) ? route('admin.regulations.save') : route('admin.regulations.save.edit', ['id' => $item->id]) }}" class="form" enctype="multipart/form-data">

            {{ csrf_field() }}

            @if(isset($item->id))
                <input type="hidden" name="id" value="{{ $item->id }}">
            @endif

            <div class="col-md-12">
                <div class="form-group @if( is_error('title') )has-error @endif">
                    <label for="edit-form-title">* Title</label>
                    <input type="text"
                           name="title"
                           value="{{ !empty($old_input['title']) ? $old_input['title'] : $item->title }}"
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
                    <label for="edit-form-content">* Content</label>
                    <textarea name="content"
                              required
                              id="edit-form-content"
                    >{{ !empty($old_input['content']) ? $old_input['content'] : $item->content }}</textarea>
                </div>
                <div class="form-group">
                    <input type="checkbox"
                           name="is_active"
                           value="1"
                           {{ !empty($old_input['is_active']) || !empty($item->is_active) ? 'checked' : '' }}
                           id="edit-form-active">
                    <label for="edit-form-active">Published</label>
                </div>
            </div>

            <div class="col-md-12" style="margin-top: 25px;">
                <button class="btn btn-primary">
                    <i class="fa fa-floppy-o" aria-hidden="true"></i>
                    &nbsp;&nbsp;
                    Save
                </button>
            </div>

        {!! Form::close() !!}
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