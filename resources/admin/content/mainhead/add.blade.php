@extends('Admin::index')

@section('content')
    @include('Admin::alerts')

    <div>
        <a href="{{ route('mainheader.list') }}" class="btn-sm btn-primary pull-right">
            <i class="fa fa-arrow-left" aria-hidden="true"></i>
            &nbsp;&nbsp;
            back to list
        </a>
        <h3 class="sub-header">
            @if( empty($item->id) )
                Create Main header icon
            @else
                Edit Main header icon
            @endif
        </h3>
    </div>

    <form action="{{ empty($item->id) ? route('mainheader.add.post') : route('mainheader.update', ['id' => $item->id]) }}" method="post">

        {{ csrf_field() }}

        <div class="row">
            <div class="col-xs-12 col-md-4">
                <div class="form-group @if( is_error('name') )has-error @endif">
                    <label for="name">Name</label>
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
                    <label for="link">Link</label>
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
                    <label for="icon">Icon</label>
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
                    <button type="submit" class="btn btn-main-carousel btn-flat ">{{ empty($item->id) ? "Create" : "Edit" }}</button>
                </div>
            </div>

            <div class="col-xs-4 col-md-8">
                <div class="help_block">
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