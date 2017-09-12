@extends('user')

@section('content')
    @include('alerts')

    <div class="row">
        <div class="col-xs-12">
            <h1 class="page-header">Профиль</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <div class="news__item profile__item ">
                {{ route('register').'/'.$user->ref_link }}
            </div>
            <div class="news__item profile__item">
                Платежная инфа
            </div>
        </div>
        <div class="col-xs-12 col-md-6">
            <div class="news__item profile__item">
                <h4>
                    Паспортные данные

                    @if($passport_data->is_confirm)
                        <div class="profile_status_ok profile_status" title="Документ не подтвержден">
                            <i class="fa fa-check-square-o" aria-hidden="true"></i>
                        </div>
                    @else
                        <div class="profile_status_not_ok profile_status" title="Документ не подтвержден">
                            <i class="fa fa-window-close-o" aria-hidden="true"></i>
                        </div>
                    @endif

                    <i class="fa fa-pencil-square-o edit_passport_data" aria-hidden="true" title="Редактировать"></i>
                    <i class="fa fa-times close_passport_data_form" aria-hidden="true" title="Закрыть форму"></i>
                </h4>


                <div class="profile__item_passport_data_text">
                    <p>Имя: {{ $passport_data->name }}</p>
                    <p>Фамилия: {{ $passport_data->surname }}</p>
                    <p>Отчество: {{ $passport_data->firdname }}</p>
                    <p>Серия паспорта: {{ $passport_data->series }}</p>
                    <p>Номер паспорта: {{ $passport_data->number }}</p>
                    <p>Кем выдан: {{ $passport_data->issuedby }}</p>
                    <p>Дата выдачи: {{ \Carbon\Carbon::parse($passport_data->dateofissue)->format("d.m.Y") }}</p>
                </div>
                <div class="profile__item_passport_data_form row">
                    <form action="{{ route('profile.edit') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group col-xs-12 @if( is_error('name') )has-error @endif">
                            <label for="name">Имя</label>
                            <input type="text" class="form-control btn-flat" name="name" id="name" placeholder="Ваше имя" value="{{ isset($passport_data->name) ? $passport_data->name : "" }}">
                            @if( is_error('name') )
                                <span class="help-block">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="form-group col-xs-12 @if( is_error('surname') )has-error @endif">
                            <label for="surname">Фамилия</label>
                            <input type="text" class="form-control btn-flat" name="surname" id="surname" placeholder="Ваша фамилия" value="{{ isset($passport_data->surname) ? $passport_data->surname : "" }}">
                            @if( is_error('surname') )
                                <span class="help-block">{{ $errors->first('surname') }}</span>
                            @endif
                        </div>
                        <div class="form-group col-xs-12 @if( is_error('firdname') )has-error @endif">
                            <label for="firdname">Отчество</label>
                            <input type="text" class="form-control btn-flat" name="firdname" id="firdname" placeholder="Ваше отчество" value="{{ isset($passport_data->firdname) ? $passport_data->firdname : "" }}">
                            @if( is_error('firdname') )
                                <span class="help-block">{{ $errors->first('firdname') }}</span>
                            @endif
                        </div>
                        <div class="form-group col-xs-12 col-md-3 @if( is_error('series') )has-error @endif">
                            <label for="series">Серия паспорта</label>
                            <input type="text" class="form-control btn-flat" name="series" id="series" placeholder="Серия Вашего паспорта" value="{{ isset($passport_data->series) ? $passport_data->series : "" }}">
                            @if( is_error('series') )
                                <span class="help-block">{{ $errors->first('series') }}</span>
                            @endif
                        </div>
                        <div class="form-group col-xs-12 col-md-9 @if( is_error('number') )has-error @endif">
                            <label for="number">Номер паспорта</label>
                            <input type="text" class="form-control btn-flat" name="number" id="number" placeholder="Номер Вашего паспорта" value="{{ isset($passport_data->number) ? $passport_data->number : "" }}">
                            @if( is_error('number') )
                                <span class="help-block">{{ $errors->first('number') }}</span>
                            @endif
                        </div>
                        <div class="form-group col-xs-12 @if( is_error('issuedby') )has-error @endif">
                            <label for="issuedby">Кем выдан</label>
                            <input type="text" class="form-control btn-flat" name="issuedby" id="issuedby" placeholder="Кем выдан Ваш паспорт" value="{{ isset($passport_data->issuedby) ? $passport_data->issuedby : "" }}">
                            @if( is_error('issuedby') )
                                <span class="help-block">{{ $errors->first('issuedby') }}</span>
                            @endif
                        </div>
                        <div class="form-group col-xs-12 @if( is_error('dateofissue') )has-error @endif">
                            <label for="dateofissue">Дата выдачи</label>
                            <input type="text" class="form-control btn-flat datepicker" name="dateofissue" id="dateofissue" placeholder="Дата выдачи Вашего паспорта" value="{{ isset($passport_data->dateofissue) ? $passport_data->dateofissue : "" }}">
                            @if( is_error('dateofissue') )
                                <span class="help-block">{{ $errors->first('dateofissue') }}</span>
                            @endif
                        </div>
                        <input type="hidden" name="is_confirm" value="{{ isset($passport_data->is_confirm) ? $passport_data->is_confirm : 0 }}">
                        <div class="form-group col-xs-12">
                            <button type="submit" class="btn btn-main-carousel btn-flat">Сохранить</button>
                            <label for="file" class="passport_data_scans_label btn btn-main-carousel btn-flat">Загрузить сканы паспорта</label>
                            <input type="file" id="file" multiple name="scans[]" class="passport_data_scans_button">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-12">
            <div class="news__item profile__item">
                @forelse($scans as $scan)
                    <a href="{{ asset('storage').'/'.$scan->path }}" data-fancybox="group">
                        <div class="profile_scan_img__wrap" style="background-image: url({{ asset('storage').'/'.$scan->path }})">
                            @if($scan->is_confirm)
                                <div class="profile_scan_status_ok profile_scan_status" title="Документ не подтвержден">
                                    <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                </div>
                            @else
                                <div class="profile_scan_status_not_ok profile_scan_status" title="Документ не подтвержден">
                                    <i class="fa fa-window-close-o" aria-hidden="true"></i>
                                </div>
                            @endif
                        </div>
                    </a>
                @empty
                    
                @endforelse
            </div>
        </div>
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

            $("[data-fancybox]").fancybox({
            });

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
            $(".passport_data_scans_button").on("change", function(){
                var filesNumb = document.getElementById('file').files.length,
                    txt = "";
                switch(filesNumb){
                    case 0 :
                        txt = "Загрузить сканы паспорта";
                    case 1 :
                        txt = "Выбран 1 файл";
                }

                if(filesNumb == 0){
                    txt = "Загрузить сканы паспорта";
                }else{
                    if(filesNumb == 1){
                        txt = "Выбран 1 файл";
                    }else if(filesNumb > 1 && filesNumb < 5){
                        txt = "Выбрано "+filesNumb+" файла";
                    }else{
                        txt = "Выбрано "+filesNumb+" файлов";
                    }
                }

                $(".passport_data_scans_label").text(txt);
            });
        });
    </script>
@stop