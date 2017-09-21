@extends('Admin::index')

@section('content')
    @include('Admin::alerts')

        <div>
            <a href="{{ route('admin-subscriptions-list') }}" class="btn-sm btn-primary pull-right">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
                &nbsp;&nbsp;
                назад
            </a>

            <h3 class="sub-header">
                @if( empty($item->id) )
                    Создать тариф
                @else
                    Редактировать тариф
                @endif
            </h3>
        </div>

    <div class="row">
        {!! Form::open(['class' => 'form']) !!}

            <div class="col-xs-12 col-md-6" id="form-container">
                <div class="form-group @if( is_error('name') )has-error @endif">
                    {!! Form::label('edit-form-name', '* Название') !!}
                    {!! Form::text('name', !empty($item->name) ? $item->name : '', ['id' => 'edit-form-name', 'class' => 'form-control', 'maxlength' => "255", 'required' => 'required' ]) !!}
                    @if( is_error('name') )
                        <span class="help-block">{{ $errors->first('name') }}</span>
                    @endif
                </div>

                <div class="form-group @if( is_error('price') )has-error @endif">
                    {!! Form::label('edit-form-price', '* Цена') !!}
                    {!! Form::number('price', !empty($item->price) ? $item->price : '', ['id' => 'edit-form-price', 'class' => 'form-control', 'maxlength' => "255", 'required' => 'required' ]) !!}
                    @if( is_error('price') )
                        <span class="help-block">{{ $errors->first('price') }}</span>
                    @endif
                </div>

                <div class="form-group @if( is_error('term') )has-error @endif">
                    {!! Form::label('edit-form-term', '* Срок действия(дней)') !!}
                    {!! Form::number('term', !empty($item->term) ? $item->term : '30', ['id' => 'edit-form-term', 'class' => 'form-control', 'maxlength' => "255", 'required' => 'required' ]) !!}
                    @if( is_error('term') )
                        <span class="help-block">{{ $errors->first('term') }}</span>
                    @endif
                </div>

                <div class="form-group @if( is_error('levels') )has-error @endif">
                    {!! Form::label('edit-form-levels', '* Уровни') !!}
                    {!! Form::number('levels', !empty($item->levels) ? $item->levels : '0', ['id' => 'edit-form-levels', 'class' => 'form-control', 'max' => "10000", 'required' => 'required']) !!}
                    @if( is_error('levels') )
                        <span class="help-block">{{ $errors->first('levels') }}</span>
                    @endif
                </div>

                @foreach($item->prices as $key => $price)
                    <div class="form-group">
                        @if ($key != 0)
                            <hr>
                        @endif
                            {!! Form::label('edit-form-level-count-' . $price->level, 'Уровень ' . ($price->level + 1)) !!}
                            {!! Form::number('level[' . $price->level . '][count]', $price->value, ['id' => 'edit-form-level-count-' . $price->level, 'class' => 'form-control', 'maxlength' => "255", 'min' => "0", 'required' => 'required']) !!}
                            {!! Form::checkbox('level[' . $price->level . '][is_percent]', 1, $price->is_percent ? true : false, ['id' => 'edit-form-level-percent-' . $price->level]) !!}
                            {!! Form::label('edit-form-level-percent-' . $price->level, 'Процент') !!}
                    </div>
                @endforeach

            </div>

            @if( !empty($item->id) )
                <div class="col-xs-12 col-md-6">
                    <div class="form-group @if( is_error('description') )has-error @endif">
                        {!! Form::label('edit-form-description', 'Описание') !!}
                        {!! Form::textarea('description', !empty($item->description) ? $item->description : '', ['id' => 'edit-form-description', 'class' => 'form-control', 'rows' => '3' ]) !!}
                        @if( is_error('description') )
                            <span class="help-block">{{ $errors->first('description') }}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        {!! Form::checkbox('is_active', 1, $item->is_active ? true : false) !!}
                        {!! Form::label('is_active', 'Активен') !!}
                    </div>
                </div>
            @else
                {!! Form::hidden('is_active', 1) !!}
            @endif

            <div class="col-md-12" style="margin-top: 25px;">
                {!! Form::customButton('Сохранить', 'btn btn-primary', 'fa-floppy-o') !!}
            </div>

        {!! Form::close() !!}
    </div>



@push('footer-scripts')
<script type="text/javascript">

    var levels = $('#edit-form-levels').val()*1;
    var max_levels = $('#edit-form-levels').attr('max')*1;
    var min_levels = 0;
    changeLevels(levels);

    $('#edit-form-levels').on('change keyup', function(e) {
        var target = e.target;
        console.log()
        if (target.value > max_levels) {
            target.value = max_levels;
        }
        if (target.value < min_levels) {
            target.value = min_levels;
        }
        if (target.value) {
            changeLevels(target.value);
        }
    });
    function changeLevels (value) {
        var value = value*1;
        var hr = '<hr>';
        if (value > levels) {
            for (var i = levels; i < value ; i++) {
                if (i == 0) {
                    hr = ''
                }
                $('#form-container').append(
                        '<div class="form-group">' +
                            hr +
                            '<label for="edit-form-level-count-' + i + '">Уровень ' + (i * 1 + 1) + '</label>' +
                            '<input name="level[' + i + '][count]"  id="edit-form-level-count-' + i + '" class="form-control" required="required" maxlength="255" min="0" type="number">' +
                            '<input name="level[' + i + '][is_percent]" id="edit-form-level-percent-' + i + '" type="checkbox"> ' +
                            '<label for="edit-form-level-percent-' + i + '">Процент</label>' +
                        '</div>'
                )
            }
        } else if (value < levels) {
            for (var i = levels; i >= value; i--) {
                $('#edit-form-level-count-' + i).parent().remove();
            }

        }
        levels = value;
    }
</script>
@endpush

@endsection
