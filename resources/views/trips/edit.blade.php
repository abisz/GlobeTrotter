@extends('app')

@section('content')

    <h1>Edit Trip "{{$trip->name}}":</h1>

    <hr/>

    {!! Form::model($trip, ['method' => 'PATCH', 'url' => 'trip/update/' . $trip->id]) !!}

    @include('trips.form', ['submitButtonText' => 'Update Trip', 'start' => Carbon\Carbon::parse($trip->start)->format('Y-m-d'), 'end' => Carbon\Carbon::parse($trip->end)->format('Y-m-d')])

    {!! Form::close() !!}

    @include('errors.list')

@stop