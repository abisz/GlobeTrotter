@extends('app')

@section('content')

    <h1>Upload new Picture to {{$entry->name}}</h1>

    <hr/>

    {!! Form::open(['files'=>true]) !!}

    @include('pictures.form', ['submitButtonText' => 'Save Picture'])

    {!! Form::close() !!}

    @include('errors.list')

@stop