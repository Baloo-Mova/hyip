@extends('user')

@section('content')
    {{--@include('alerts')--}}

    <div class="row">
        <div class="col-xs-12">
            <h1 class="page-header">@lang("messages.profile")</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <div class="news__item profile__item">
                <h4>
                    @lang("messages.passport_data")
                    @if($user->is_confirm)
                        <div class="profile_status_ok profile_status" title="@lang("messages.document_verified")">
                            <i class="fa fa-check-square-o" aria-hidden="true"></i>
                        </div>
                    @else
                        <div class="profile_status_not_ok profile_status" title="@lang("messages.document_not_verified")">
                            <i class="fa fa-window-close-o" aria-hidden="true"></i>
                        </div>
                    @endif

                    <i class="fa fa-pencil-square-o edit_passport_data" aria-hidden="true" title="Редактировать"></i>
                    <i class="fa fa-times close_passport_data_form" aria-hidden="true" title="Закрыть форму"></i>
                </h4>


                <div class="profile__item_passport_data_text">
                    <p>@lang("messages.name"): {{ $passport_data->name }}</p>
                    <p>@lang("messages.surname"): {{ $passport_data->surname }}</p>
                    <p>@lang("messages.middlename"): {{ $passport_data->middleName }}</p>
                    <p>@lang("messages.passport_series"): {{ $passport_data->series }}</p>
                    <p>@lang("messages.passport_number"): {{ $passport_data->number }}</p>
                    <p>@lang("messages.passport_issuedby"): {{ $passport_data->issuedby }}</p>
                    <p>@lang("messages.passport_dateofissue"): {{ !empty($passport_data->dateofissue) ? \Carbon\Carbon::parse($passport_data->dateofissue)->format("d.m.Y") : "" }}</p>
                </div>
                <div class="profile__item_passport_data_form row">
                    <form action="{{ route('profile.edit') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group col-xs-12 @if( is_error('name') )has-error @endif">
                            <label for="name">@lang("messages.name")</label>
                            <input type="text" class="form-control btn-flat" name="name" id="name"
                                   placeholder="@lang("messages.name")"
                                   value="{{ $passport_data->name  }}">
                            @if( is_error('name') )
                                <span class="help-block">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="form-group col-xs-12 @if( is_error('surname') )has-error @endif">
                            <label for="surname">@lang("messages.surname")</label>
                            <input type="text" class="form-control btn-flat" name="surname" id="surname"
                                   placeholder="@lang("messages.surname")"
                                   value="{{  $passport_data->surname }}">
                            @if( is_error('surname') )
                                <span class="help-block">{{ $errors->first('surname') }}</span>
                            @endif
                        </div>
                        <div class="form-group col-xs-12 @if( is_error('middleName') )has-error @endif">
                            <label for="middleName">@lang("messages.middlename")</label>
                            <input type="text" class="form-control btn-flat" name="middleName" id="middleName"
                                   placeholder="@lang("messages.middlename")" value="{{  $passport_data->middleName }}">
                            @if( is_error('firdname') )
                                <span class="help-block">{{ $errors->first('middleName') }}</span>
                            @endif
                        </div>
                        <div class="form-group col-xs-12 col-md-3 @if( is_error('series') )has-error @endif">
                            <label for="series">@lang("messages.passport_series")</label>
                            <input type="text" class="form-control btn-flat" name="series" id="series"
                                   placeholder="@lang("messages.passport_series")"
                                   value="{{ $passport_data->series }}">
                            @if( is_error('series') )
                                <span class="help-block">{{ $errors->first('series') }}</span>
                            @endif
                        </div>
                        <div class="form-group col-xs-12 col-md-9 @if( is_error('number') )has-error @endif">
                            <label for="number">@lang("messages.passport_number")</label>
                            <input type="text" class="form-control btn-flat" name="number" id="number"
                                   placeholder="@lang("messages.passport_number")"
                                   value="{{  $passport_data->number  }}">
                            @if( is_error('number') )
                                <span class="help-block">{{ $errors->first('number') }}</span>
                            @endif
                        </div>
                        <div class="form-group col-xs-12 @if( is_error('issuedby') )has-error @endif">
                            <label for="issuedby">@lang("messages.passport_issuedby")</label>
                            <input type="text" class="form-control btn-flat" name="issuedby" id="issuedby"
                                   placeholder="@lang("messages.passport_issuedby")"
                                   value="{{  $passport_data->issuedby }}">
                            @if( is_error('issuedby') )
                                <span class="help-block">{{ $errors->first('issuedby') }}</span>
                            @endif
                        </div>
                        <div class="form-group col-xs-12 @if( is_error('dateofissue') )has-error @endif">
                            <label for="dateofissue">@lang("messages.passport_dateofissue")</label>
                            <input type="text" class="form-control btn-flat datepicker" name="dateofissue"
                                   id="dateofissue" placeholder="@lang("messages.passport_dateofissue")"
                                   value="{{  $passport_data->dateofissue }}">
                            @if( is_error('dateofissue') )
                                <span class="help-block">{{ $errors->first('dateofissue') }}</span>
                            @endif
                        </div>
                        <input type="hidden" name="is_confirm"
                               value="{{ isset($passport_data->is_confirm) ? $passport_data->is_confirm : 0 }}">
                        <div class="form-group col-xs-12">
                            <button type="submit" class="btn btn-main-carousel btn-flat">@lang("messages.save")</button>
                            <label for="file" class="passport_data_scans_label btn btn-main-carousel btn-flat">@lang("messages.download_passport_scans")</label>
                            <input type="file" id="file" multiple name="scans[]" class="passport_data_scans_button">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-md-6">
            <div class="news__item profile__item">
                <h4>@lang("messages.change_password")</h4>
                <form action="{{ route('profile.change.password') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group @if( is_error('old_password') )has-error @endif">
                        <label for="old_password">@lang("messages.label_old_password")</label>
                        <input type="password" class="form-control btn-flat" name="old_password"
                               id="old_password" placeholder="@lang("messages.label_old_password")">
                        @if( is_error('old_password') )
                            <span class="help-block">{{ $errors->first('old_password') }}</span>
                        @endif
                    </div>
                    <div class="form-group @if( is_error('new_password') )has-error @endif">
                        <label for="new_password">@lang("messages.label_new_password")</label>
                        <input type="password" class="form-control btn-flat" name="new_password"
                               id="new_password" placeholder="@lang("messages.label_new_password")">
                        @if( is_error('new_password') )
                            <span class="help-block">{{ $errors->first('new_password') }}</span>
                        @endif
                    </div>
                    <div class="form-group @if( is_error('new_password_second') )has-error @endif">
                        <label for="new_password_second">@lang("messages.label_new_password_second")</label>
                        <input type="password" class="form-control btn-flat" name="new_password_second"
                               id="new_password_second" placeholder="@lang("messages.label_new_password_second")">
                        @if( is_error('new_password_second') )
                            <span class="help-block">{{ $errors->first('new_password_second') }}</span>
                        @endif
                    </div>
                    <div class="form-group @if( is_error('new_password_second') )has-error @endif">
                        <button class="btn btn-main-carousel btn-flat" type="submit">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>

        @if(count($scans) > 0)
            <div class="col-xs-12 col-md-12">
                <div class="news__item profile__item">
                    @foreach($scans as $scan)
                        <a href="{{ route('get.image', ['type' => 'scans', 'name' => $scan->photo]) }}" data-fancybox="group">
                            <div class="profile_scan_img__wrap"
                                 style="background-image: url({{ route('get.image', ['type' => 'scans', 'name' => $scan->preview]) }})">
                                @if($user->is_confirm)
                                    <div class="profile_scan_status_ok profile_scan_status"
                                         title="@lang("messages.document_verified")">
                                        <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                    </div>
                                @else
                                    <div class="profile_scan_status_not_ok profile_scan_status"
                                         title="@lang("messages.document_not_verified")">
                                        <i class="fa fa-window-close-o" aria-hidden="true"></i>
                                    </div>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('.datepicker').datepicker({
                format: 'dd.mm.yyyy',
                todayBtn: 'linked',
                autoclose: true,
                language: 'ru'
            });

            $("[data-fancybox]").fancybox({});

            $(".edit_passport_data").on("click", function () {
                $(".edit_passport_data").hide();
                $(".close_passport_data_form").show();
                $(".profile__item_passport_data_text").hide();
                $(".profile__item_passport_data_form").show();
            });
            $(".close_passport_data_form").on("click", function () {
                $(".edit_passport_data").show();
                $(".close_passport_data_form").hide();
                $(".profile__item_passport_data_text").show();
                $(".profile__item_passport_data_form").hide();
            });
            $(".passport_data_scans_button").on("change", function () {
                var filesNumb = document.getElementById('file').files.length,
                    txt = "";
                switch (filesNumb) {
                    case 0 :
                        txt = "{{ __("messages.download_passport_scans") }}";
                    case 1 :
                        txt = "{{ __("messages.selected") }} 1 {{ __("messages.file") }}";
                }

                if (filesNumb == 0) {
                    txt = "{{ __("messages.download_passport_scans") }}";
                } else {
                    if (filesNumb == 1) {
                        txt = "{{ __("messages.selected") }} 1 {{ __("messages.file") }}";
                    } else if (filesNumb > 1 && filesNumb < 5) {
                        txt = "{{ __("messages.selected") }} " + filesNumb + " {{ __("messages.files") }}";
                    } else {
                        txt = "{{ __("messages.selected") }} " + filesNumb + " {{ __("messages.files") }}";
                    }
                }

                $(".passport_data_scans_label").text(txt);
            });
        });
    </script>
@stop