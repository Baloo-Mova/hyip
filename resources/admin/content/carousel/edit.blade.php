@extends('Admin::index')

@section('content')
    @include('Admin::alerts')

        <div>
            <a href="{{ route('admin.carousel.list') }}" class="btn-sm btn-primary pull-right">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
                &nbsp;&nbsp;
                назад
            </a>

            <h3 class="sub-header">
                @if( empty($item->id) )
                    Добавить слайд
                @else
                    Редактировать слайд
                @endif
            </h3>
        </div>

    <div class="row">
        <form action="" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
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
            <div class="clearfix"></div>
            <div class="col-xs-12 col-md-4">
                <div class="form-group @if( is_error('text') )has-error @endif">
                    <label for="text">Текст слайда</label>
                    <textarea name="text" class="form-control" id="text">{{ isset($item) ? $item->text : "" }}</textarea>
                    @if( is_error('text') )
                        <span class="help-block">{{ $errors->first('text') }}</span>
                    @endif
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-xs-12 col-md-4">
                <div class="form-group @if( is_error('file') )has-error @endif">
                        <label for="file">Картинка слайда</label>
                        <br>
                    @if(isset($item) && isset($item->background_file))
                        <img src="{{ route('get.image', ['type' => 'carousel', 'name' => $item->background_file]) }}" alt="" style="width: 100px;">
                        <input type="hidden" name="file" value="{{ $item->background_file }}">
                        <br>
                        <a href="{{ route('admin.carousel.delete.image', ['id' => $item->id]) }}" class="btn btn-primary mt10">Удалить</a>
                    @else
                        <input type="file" name="file">
                    @endif
                    @if( is_error('file') )
                        <span class="help-block">{{ $errors->first('file') }}</span>
                    @endif
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="buttons__wrap">
                @if(isset($item) && !empty($item))
                    <?php $buttons = json_decode($item->buttons); ?>
                    @foreach($buttons as $key=>$button)
                        <?php ++$key; ?>
                        <div class="col-xs-12 col-md-4 button_{{$key}}">
                            @if($key == 1)
                                <h4>Кнопка {{ $key }} <i class="fa fa-plus-square add_carousel_buttons" aria-hidden="true" data-current="{{ count($buttons) }}" title="Добавить новую кнопку"></i></h4>
                            @else
                                <h4>Кнопка {{ $key }} <i class="fa fa-minus-square carousel_crud_delete_button" aria-hidden="true" title="Удалить эту кнопку" data-button="{{$key}}"></i></h4>
                            @endif

                            <hr>
                            <div class="form-group">
                                <label for="button_text[{{$key}}]">Текст</label>
                                <input type="text" class="form-control" name="button_text[{{$key}}]" value="{{ $button->text }}">
                            </div>
                        </div>
                        <div class="clearfix button_{{$key}}"></div>
                        <div class="col-xs-12 col-md-4 button_{{$key}}">
                            <div class="form-group">
                                <label for="url[{{$key}}]">Ссылка</label>
                                <input type="text" class="form-control" name="url[{{$key}}]" value="{{ $button->url }}">
                            </div>
                        </div>
                        <div class="clearfix button_{{$key}}"></div>
                    @endforeach
                @else
                    <div class="col-xs-12 col-md-4">
                        <h4>Кнопка 1 <i class="fa fa-plus-square add_carousel_buttons" aria-hidden="true" data-current="1" title="Добавить новую кнопку"></i></h4>
                        <hr>
                        <div class="form-group">
                            <label for="button_text[1]">Текст</label>
                            <input type="text" class="form-control" name="button_text[1]">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-xs-12 col-md-4">
                        <div class="form-group">
                            <label for="url[1]">Ссылка</label>
                            <input type="text" class="form-control" name="url[1]">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                @endif
            </div>
            <div class="clearfix"></div>
            <div class="col-xs-12 col-md-4">
                <div class="form-group ">
                    <label for="need_show">
                        <input type="checkbox" name="need_show" id="need_show" {{ isset($item) && $item->need_show ? "checked" : "" }}>
                        Активен
                    </label>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-xs-12 col-md-4">
                <div class="form-group ">
                    <button class="btn btn-flat btn-success" type="submit">Сохранить</button>
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

               $(".buttons__wrap").append('<div class="col-xs-12 col-md-4 button_'+current+'">'+
                   '<h4>Кнопка '+current+
                   ' <i class="fa fa-minus-square carousel_crud_delete_button" aria-hidden="true" title="Удалить эту кнопку" data-button="'+current+'"></i>'+
                   '</h4>'+
                   '<hr>'+
                   '<div class="form-group">'+
                   '<label for="button_text['+current+']">Текст</label>'+
                   '<input type="text" class="form-control" name="button_text['+current+']">'+
                   '</div>'+
                   '</div>'+
                   '<div class="clearfix"></div>'+
                   '<div class="col-xs-12 col-md-4 button_'+current+'">'+
                   '<div class="form-group">'+
                   '<label for="url['+current+']">Ссылка</label>'+
                   '<input type="text" class="form-control" name="url['+current+']">'+
                   '</div>'+
                   '</div>'+
                   '<div class="clearfix button_'+current+'"></div>');
           });

           $("body").on("click", ".carousel_crud_delete_button", function () {
              var button = $(this).data("button");
              $(".button_"+button).remove();
           });
        });
    </script>
@stop
