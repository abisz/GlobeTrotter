@extends('app')

@section('content')

    <h1>Edit Entry "{{$entry->name}}":</h1>

    <hr/>

    {!! Form::model($entry, ['method' => 'PATCH', 'url' => 'trip/' . $trip->id . '/entry/' . $entry->id . '/update']) !!}

    @include('entries.form', ['submitButtonText' => 'Update Entry', 'date' => Carbon\Carbon::parse($entry->date)->format('Y-m-d')])

    {!! Form::close() !!}

    @include('errors.list')

@stop