@extends('Admin::index')

@section('content')
    @include('Admin::alerts')

    <div>
        <a href="{{ route('admin.social-networks.list') }}" class="btn-sm btn-primary pull-right">
            <i class="fa fa-arrow-left" aria-hidden="true"></i>
            &nbsp;&nbsp;
            назад
        </a>
        <h3 class="sub-header">
            @if( empty($item->id) )
                Создать ссылку соц.сети
            @else
                Редактировать ссылку соц.сети
            @endif
        </h3>
    </div>

    <form action="{{ empty($item->id) ? route('admin.social-networks.save') : route('admin.social-networks.edit.save', ['id' => $item->id]) }}" method="post">

        {{ csrf_field() }}

        <div class="row">
            <div class="col-xs-12 col-md-4">
                <div class="form-group @if( is_error('name') )has-error @endif">
                    <label for="name">Название</label>
                    <input type="text"
                           name="name"
                           value="{{ !empty($item->name) ? $item->name : '' }}"
                           id="name"
                           class="form-control"
                           maxlength="255"
                           required
                    >
                    @if( is_error('name') )
                        <span class="help-block">{{ $errors->first('name') }}</span>
                    @endif
                </div>

                <div class="form-group @if( is_error('link') )has-error @endif">
                    <label for="link">Ссылка</label>
                    <input type="text"
                           name="link"
                           value="{{ !empty($item->link) ? $item->link : '' }}"
                           id="link"
                           class="form-control"
                           maxlength="255"
                           required
                    >
                    @if( is_error('link') )
                        <span class="help-block">{{ $errors->first('link') }}</span>
                    @endif
                </div>

                <div class="form-group @if( is_error('icon') )has-error @endif">
                    <label for="icon">Иконка</label>
                    <input type="text"
                           name="icon"
                           value="{{ !empty($item->icon) ? $item->icon : '' }}"
                           id="icon"
                           class="form-control"
                           maxlength="255"
                           placeholder="demo-icon icon-vk"
                           required
                    >
                    @if( is_error('icon') )
                        <span class="help-block">{{ $errors->first('icon') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-main-carousel btn-flat ">{{ empty($item->id) ? "Создать" : "Редактировать" }}</button>
                </div>
            </div>

            <div class="col-xs-12 col-md-4">
                <div class="help_block">
                    <label>Класс иконок: </label>
                    <ul class="help_block_ul">
                        <li>
                            <i class="demo-icon icon-vk"></i> - demo-icon icon-vk
                        </li>
                        <li>
                            <i class="demo-icon icon-fb"></i> - demo-icon icon-fb
                        </li>
                        <li>
                            <i class="demo-icon icon-ins"></i> - demo-icon icon-ins
                        </li>
                        <li>
                            <i class="demo-icon icon-ok"></i> - demo-icon icon-ok
                        </li>
                        <li>
                            <i class="demo-icon icon-tw"></i> - demo-icon icon-tw
                        </li>
                        <li>
                            <i class="demo-icon icon-tl"></i> - demo-icon icon-tl
                        </li>
                    </ul>
                </div>
            </div>


        </div>

    </form>

@endsection
