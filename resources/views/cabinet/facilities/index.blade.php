@extends('user')

@section('content')
    @include('alerts')

    <h1 class="page-header">Ввод/вывод </h1>

    <h2>Пополнить счет</h2>
    {!! Form::open(['class' => 'form', 'route' => 'facilities.refill']) !!}
        {!! Form::label('count', 'Пополнить на: ') !!}
        {!! Form::number('count', '', ['id' => 'count', 'required' => 'required']) !!}
        {!! Form::button('Пополнить', ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
@endsection