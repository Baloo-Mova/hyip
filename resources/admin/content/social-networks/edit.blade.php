@extends('Admin::index')

@section('content')
    @include('Admin::alerts')

        <div>
            <a href="{{ route('admin.social-networks.list') }}" class="btn-sm btn-primary pull-right">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
                &nbsp;&nbsp;
                back to list
            </a>

            <h3 class="sub-header">
                @if( empty($item->id) )
                    Create social network
                @else
                    Edit social network
                @endif
            </h3>
        </div>

    <div class="row">
        <form method="POST" class="form" enctype="multipart/form-data">

            {{ csrf_field() }}

            <div class="col-md-6">
                <div class="form-group @if( is_error('name') )has-error @endif">
                    <label for="edit-form-name">* Name</label>
                    <input type="text"
                           name="name"
                           value="{{ !empty($item->name) ? $item->name : '' }}"
                           id="edit-form-name"
                           class="form-control"
                           maxlength="255"
                           required
                    >
                    @if( is_error('name') )
                        <span class="help-block">{{ $errors->first('name') }}</span>
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group @if( is_error('link') )has-error @endif">
                    <label for="edit-form-link">* Link</label>
                    <input type="text"
                           name="link"
                           value="{{ !empty($item->link) ? $item->link : '' }}"
                           id="edit-form-link"
                           class="form-control"
                           maxlength="255"
                           required
                    >
                    @if( is_error('link') )
                        <span class="help-block">{{ $errors->first('link') }}</span>
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group @if( is_error('img') ) has-error @endif" id="edit-img">
                    <label for="edit-form-img">Image</label>
                    @if( !empty($item->img) )
                        <div style="width: 110px;">
                            <div style="width: 100px; margin: 0 auto; padding: 0;">
                                <img src="/media/uploads/social-networks/{{ $item->img }}" width="100px" />
                            </div>
                            <button class="btn btn-primary" style="margin: 0 auto;" type="button" onclick="deleteImg('img')">Delete</button>
                        </div>
                    @else
                        <input type="file" id="edit-form-img" name="img">
                    @endif
                </div>

                <div class="form-group @if( is_error('black_img') ) has-error @endif" id="edit-black_img">
                    <label for="edit-form-black_img">Black image</label>
                    @if( !empty($item->black_img) )
                        <div style="width: 110px;">
                            <div style="width: 100px; margin: 0 auto; padding: 0;">
                                <img src="/media/uploads/social-networks/{{ $item->black_img }}" width="100px" />
                            </div>
                            <button class="btn btn-primary" style="margin: 0 auto;" type="button" onclick="deleteImg('black_img')">Delete</button>
                        </div>
                    @else
                        <input type="file" id="edit-form-black_img" name="black_img">
                    @endif
                </div>
            </div>

            <div class="col-md-12">
                <button class="btn btn-primary">
                    <i class="fa fa-floppy-o" aria-hidden="true"></i>
                    &nbsp;&nbsp;
                    Save
                </button>
            </div>

        </form>
    </div>

@endsection

@push('footer-scripts')
@if(!empty($item->id))
    <script type="text/javascript">
        var deleteImg = function(type) {
            $.getJSON('/admin/social-networks/image-delete/{{ $item->id }}/' + type, function(data) {
                if( typeof(data.success) != 'undefined' && data.success == true ) {
                    $('#edit-' + type + ' div:first').remove();
                    $('#edit-' + type).append(
                            $('<input/>', {type: 'file', name: type})
                    );
                }
            });
        };
    </script>
@endif
@endpush