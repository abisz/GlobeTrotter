@extends('app')

@section('content')

    <h1>New Trip</h1>

    <hr/>

    {!! Form::open() !!}

   @include('trips.form', ['submitButtonText' => 'Add Trip', 'start' => null, 'end' => null])

    {!! Form::close() !!}

    @include('errors.list')

@stop