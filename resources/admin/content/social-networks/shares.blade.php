@extends('Admin::index')

@section('content')
    @include('Admin::alerts')

    <div>
        <h3 class="sub-header">
            Social networks share links
        </h3>
    </div>

    <form action="" method="post">

        {{ csrf_field() }}

        <div class="row">
            <div class="col-xs-12 col-md-4">
                <div class="help_block h180">
                    <div class="form-group @if( is_error('text') )has-error @endif">
                        <label for="text">Share text</label>
                        <textarea name="text" id="text" class="form-control">{{ !empty($item->text) ? $item->text : '' }}</textarea>
                        @if( is_error('name') )
                            <span class="help-block">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-md-4">
                <div class="help_block h180">
                    <label>Класс иконок: </label>
                    <ul class="help_block_ul">
                        <li>
                            <i class="demo-icon icon-vk"></i> - demo-icon icon-vk
                        </li>
                        <li>
                            <i class="demo-icon icon-fb"></i> - demo-icon icon-fb
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
            <div class="col-xs-12 col-md-4">
                <div class="help_block h180">
                    <label>Класс цветов иконок (для share icons): </label>
                    <ul class="help_block_ul">
                        <li class="vk_color">
                            <i class="demo-icon icon-vk"></i> - vk_color
                        </li>
                        <li class="fb_color">
                            <i class="demo-icon icon-fb"></i> - fb_color
                        </li>
                        <li class="ok_color">
                            <i class="demo-icon icon-ok"></i> - ok_color
                        </li>
                        <li class="tw_color">
                            <i class="demo-icon icon-tw"></i> - tw_color
                        </li>
                        <li class="tl_color">
                            <i class="demo-icon icon-tl"></i> - tl_color
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row ">
            @if(isset($item))
                @foreach(json_decode($item->shares) as $key=>$share)
                    <div class="col-xs-12 col-md-4 mt20">
                        <div class="help_block">
                            <input type="hidden" name="name[{{$key}}]" value="{{$key}}">
                            <div class="form-group">
                                <label for="link[{{$key}}]">{{$key}} link</label>
                                <input type="text" name="link[{{$key}}]" class="form-control" value="{{ !empty($share->link) ? $share->link : '' }}">
                            </div>
                            <div class="form-group">
                                <label for="icon[{{$key}}]">{{$key}} icon</label>
                                <select name="icon[{{$key}}]" id="icon[{{$key}}]" class="form-control">
                                    <option disabled {{ !empty($share->icon) ? "" : "selected" }}></option>
                                    <option value="demo-icon icon-vk" {{ !empty($share->icon) && $share->icon == "demo-icon icon-vk" ? "selected" : "" }}>
                                        demo-icon icon-vk
                                    </option>
                                    <option value="demo-icon icon-fb" {{ !empty($share->icon) && $share->icon == "demo-icon icon-fb" ? "selected" : "" }}>
                                        demo-icon icon-fb
                                    </option>
                                    <option value="demo-icon icon-ok" {{ !empty($share->icon) && $share->icon == "demo-icon icon-ok" ? "selected" : "" }}>
                                        demo-icon icon-ok
                                    </option>
                                    <option value="demo-icon icon-tw" {{ !empty($share->icon) && $share->icon == "demo-icon icon-tw" ? "selected" : "" }}>
                                        demo-icon icon-tw
                                    </option>
                                    <option value="demo-icon icon-tl" {{ !empty($share->icon) && $share->icon == "demo-icon icon-tl" ? "selected" : "" }}>
                                        demo-icon icon-tl
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="color[{{$key}}]">{{$key}} icon color</label>
                                <select name="color[{{$key}}]" id="color[{{$key}}]" class="form-control">
                                    <option disabled {{ !empty($share->color) ? "" : "selected" }}></option>
                                    <option value="vk_color" class="vk_color" {{ !empty($share->color) && $share->color == "vk_color" ? "selected" : "" }}>
                                        vk_color
                                    </option>
                                    <option value="fb_color" class="fb_color" {{ !empty($share->color) && $share->color == "fb_color" ? "selected" : "" }}>
                                        fb_color
                                    </option>
                                    <option value="ok_color" class="ok_color" {{ !empty($share->color) && $share->color == "ok_color" ? "selected" : "" }}>
                                        ok_color
                                    </option>
                                    <option value="tw_color" class="tw_color" {{ !empty($share->color) && $share->color == "tw_color" ? "selected" : "" }}>
                                        tw_color
                                    </option>
                                    <option value="tl_color" class="tl_color" {{ !empty($share->color) && $share->color == "tl_color" ? "selected" : "" }}>
                                        tl_color
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="need_show[{{$key}}]">
                                    <input type="checkbox" name="need_show[{{$key}}]" id="need_show[{{$key}}]" {{ !empty($share) && $share->need_show == 1 ? "checked" : "" }}>
                                    Need show
                                </label>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif
        </div>
        <div class="row mt20">
            <div class="col-xs-12 col-md-12">
                <div class="form-group">
                    <button type="submit" class="btn btn-main-carousel btn-flat ">Save</button>
                </div>
            </div>
        </div>

    </form>

@endsection
