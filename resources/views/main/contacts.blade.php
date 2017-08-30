@extends('main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>Контакты</h1>
            </div>
        </div>
    </div>
    <section class="contacts-information__section" id="feedback">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ea minima odio omnis qui saepe sit! Adipisci, eos quia? Asperiores cum expedita incidunt maxime molestiae neque nulla odio officia porro voluptates!
                </div>
            </div>
        </div>
    </section>
    <section class="feedback__section">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h1>Форма связи</h1>
                </div>
            </div>
            <div class="row">
                <form action="{{ route('create-feedback') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group @if( is_error('name') )has-error @endif col-xs-12 col-md-6">
                        <label for="name">Имя</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Ваше имя">
                        @if( is_error('name') )
                            <span class="help-block">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="form-group @if( is_error('email') )has-error @endif col-xs-12 col-md-6">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email"
                               placeholder="email@example.com">
                        @if( is_error('email') )
                            <span class="help-block">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="form-group @if( is_error('question') )has-error @endif col-xs-12">
                        <label for="question">Вопрос</label>
                        <textarea name="question" id="question" class="form-control contacts__textarea"></textarea>
                        @if( is_error('question') )
                            <span class="help-block">{{ $errors->first('question') }}</span>
                        @endif
                    </div>
                    <div class="form-group col-xs-12">
                        <button type="submit" class="btn btn-success">Отправить</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection

@section('js')
    <script>
        $(function () {

        });
    </script>
@stop

