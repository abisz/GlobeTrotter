@extends('app')

@section('content')

    <h1>New Entry for {{$trip->name}}</h1>

    <hr/>

    {!! Form::open() !!}

    @include('entries.form', ['submitButtonText' => 'Add Entry', 'date' => null])

    {!! Form::close() !!}

    @include('errors.list')

@stop