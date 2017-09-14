@extends('Admin::index')

@section('content')
    @include('Admin::alerts')

    <div>
        <h3 class="sub-header">
            Input/output text
        </h3>
    </div>

    <form action="" method="post">

        {{ csrf_field() }}

        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div class="form-group @if( is_error('input_title') )has-error @endif">
                    <label for="input_title">Input title</label>
                    <input type="text"
                           name="input_title"
                           value="{{ !empty($item->input_title) ? $item->input_title : '' }}"
                           id="input_title"
                           class="form-control"
                           required
                    >
                    @if( is_error('input_title') )
                        <span class="help-block">{{ $errors->first('input_title') }}</span>
                    @endif
                </div>
                <div class="form-group @if( is_error('input_text') )has-error @endif">
                    <label for="input_text">Input text</label>
                    <textarea name="input_text" id="input_text" class="form-control">{{ !empty($item->input_text) ? $item->input_text : '' }}</textarea>
                    @if( is_error('name') )
                        <span class="help-block">{{ $errors->first('input_text') }}</span>
                    @endif
                </div>
                <div class="form-group @if( is_error('output_title') )has-error @endif">
                    <label for="output_title">Output title</label>
                    <input type="text"
                           name="output_title"
                           value="{{ !empty($item->output_title) ? $item->output_title : '' }}"
                           id="output_title"
                           class="form-control"
                           required
                    >
                    @if( is_error('output_title') )
                        <span class="help-block">{{ $errors->first('output_title') }}</span>
                    @endif
                </div>
                <div class="form-group @if( is_error('output_text') )has-error @endif">
                    <label for="output_text">Output text</label>
                    <textarea name="output_text" id="output_text edit-form-content" class="form-control">{{ !empty($item->output_text) ? $item->output_text : '' }}</textarea>
                    @if( is_error('output_text') )
                        <span class="help-block">{{ $errors->first('output_text') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="need_show">
                        <input type="checkbox" name="need_show" id="need_show" {{ isset($item->need_show) && $item->need_show == 1 ? "checked" : "" }}>
                        Need show
                    </label>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-main-carousel btn-flat ">{{ empty($item->id) ? "Create" : "Edit" }}</button>
                </div>
            </div>

        </div>

    </form>

@endsection

@push('footer-scripts')
<script type="text/javascript" src="/admin-cabinet/plugins/ckeditor/ckeditor.js"></script>

<script>

$(function() {
    CKEDITOR.replace('input_text', {
        contentsCss: "{{ url( elixir('css/ts_main.css') ) }}"
    });
    CKEDITOR.replace('output_text', {
        contentsCss: "{{ url( elixir('css/ts_main.css') ) }}"
});
});

</script>
@endpush
