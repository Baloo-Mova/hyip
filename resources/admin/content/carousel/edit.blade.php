@extends('Admin::index')

@section('content')
    @include('Admin::alerts')

        <div>
            <a href="{{ route('admin.carousel.list') }}" class="btn-sm btn-primary pull-right">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
                &nbsp;&nbsp;
                back to list
            </a>

            <h3 class="sub-header">
                @if( empty($item->id) )
                    Add slide
                @else
                    Edit slide
                @endif
            </h3>
        </div>

    <div class="row">
        <form action="" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="col-xs-12 col-md-4">
                <div class="form-group @if( is_error('text') )has-error @endif">
                    <label for="text">Slide text</label>
                    <textarea name="text" class="form-control" id="text"></textarea>
                    @if( is_error('text') )
                        <span class="help-block">{{ $errors->first('text') }}</span>
                    @endif
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-xs-12 col-md-4">
                <div class="form-group @if( is_error('file') )has-error @endif">
                    <label for="file">Slide image</label>
                    <input type="file" name="file">
                    @if( is_error('file') )
                        <span class="help-block">{{ $errors->first('file') }}</span>
                    @endif
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="buttons__wrap">
                <div class="col-xs-12 col-md-4">
                    <h4>Button 1 <i class="fa fa-plus-square add_carousel_buttons" aria-hidden="true" data-current="1"></i></h4>
                    <hr>
                    <div class="form-group @if( is_error('button_text[1]') )has-error @endif">
                        <label for="button_text[1]">Text</label>
                        <input type="text" class="form-control" name="button_text[1]">
                        @if( is_error('button_text[1]') )
                            <span class="help-block">{{ $errors->first('button_text[1]') }}</span>
                        @endif
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-xs-12 col-md-4">
                    <div class="form-group @if( is_error('url[1]') )has-error @endif">
                        <label for="url[1]">Url</label>
                        <input type="text" class="form-control" name="url[1]">
                        @if( is_error('url[1]') )
                            <span class="help-block">{{ $errors->first('url[1]') }}</span>
                        @endif
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
            <div class="col-xs-12 col-md-4">
                <div class="form-group ">
                    <label for="need_show">
                        <input type="checkbox" name="need_show" id="need_show">
                        Need show
                    </label>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-xs-12 col-md-4">
                <div class="form-group ">
                    <button class="btn btn-flat btn-success" type="submit">Save</button>
                </div>
            </div>

        </form>
    </div>

@endsection

@section('js')
    <script>
        $(document).ready(function () {
           $(".add_carousel_buttons").on("click", function(){
              var current = $(this).data("current");
               current++;
               $(this).data("current", current);

               $(".buttons__wrap").append('<div class="col-xs-12 col-md-4">'+
                   '<h4>Button '+current+'</h4>'+
                   '<hr>'+
                   '<div class="form-group">'+
                   '<label for="button_text['+current+']">Text</label>'+
                   '<input type="text" class="form-control" name="button_text['+current+']">'+
                   '</div>'+
                   '</div>'+
                   '<div class="clearfix"></div>'+
                   '<div class="col-xs-12 col-md-4">'+
                   '<div class="form-group">'+
                   '<label for="url['+current+']">Url</label>'+
                   '<input type="text" class="form-control" name="url['+current+']">'+
                   '</div>'+
                   '</div>'+
                   '<div class="clearfix"></div>');
           });
        });
    </script>
@stop
