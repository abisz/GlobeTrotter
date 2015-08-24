@extends('app')

@section('content')

    <img src="{{url()}}/img/{{$trip->user_id}}/{{$pic->filename}}" alt="{{$pic->title}}" class="picture-edit"/>

    {!! Form::model($pic, ['files'=>true, 'method' => 'PATCH', 'url' => 'trip/' . $trip->id . '/entry/' . $entry->id .'/picture/'. $pic->id . '/update' ]) !!}

    @include('pictures.form', ['submitButtonText' => 'Update Picture', 'entryChecked' => false, 'tripChecked' => false])

    {!! Form::close() !!}

    @include('errors.list')

@stop