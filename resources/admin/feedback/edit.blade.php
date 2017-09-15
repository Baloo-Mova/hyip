@extends('Admin::index')

@section('content')
    @include('Admin::alerts')

        <div>
            <a href="{{ route('admin-feedback-list', ['type' => explode('/', str_replace('admin/feedback/', '', $current_uri))[0]]) }}" class="btn-sm btn-primary pull-right">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
                &nbsp;&nbsp;
                back to list
            </a>

            <h3 class="sub-header">
                Send answer
            </h3>
        </div>

    <div class="row">

        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('name', 'Name') !!}
                {!! Form::text('name', $item->name, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('', 'Email') !!}
                {!! Form::text('', $item->email, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::label('', 'Question') !!}
                {!! Form::textarea('', $item->question, ['cols' => '8', 'rows' => '5', 'class' => 'form-control', 'readonly' => 'readonly']) !!}
            </div>
        </div>

        {!! Form::open(['class' => 'form']) !!}

            <div class="col-md-12">
                <div class="form-group">
                    {!! Form::label('answer', 'Answer') !!}
                    {!! Form::textarea('answer', !empty($item->answer) ? $item->answer : '', ['cols' => '8', 'rows' => '5', 'id' => 'answer', 'class' => 'form-control', 'required' => 'required', !empty($item->answer) ? 'readonly="readonly"' : '']) !!}
                </div>
            </div>

            <div class="col-md-12" style="margin-top: 25px;">
                <button type="submit" class="btn btn-primary">Send</button>
            </div>

        {!! Form::close() !!}
    </div>

@endsection


@push('footer-scripts')
<script type="text/javascript" src="/admin-cabinet/plugins/ckeditor/ckeditor.js"></script>
<script type="text/javascript">


$(function() {
    @if( empty($item->answer) )
        CKEDITOR.replace('answer', {contentsCss: "{{ url( elixir('css/ts_main.css') ) }}"});
    @endif
});

</script>
@endpush