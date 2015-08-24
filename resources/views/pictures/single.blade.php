@extends('app')

@section('content')

    <h1>{{$pic->title}}</h1>

    <img src="{{url()}}/img/{{$trip->user_id}}/{{$pic->filename}}" alt="{{$pic->title}}" class="picture-single"/>

    <p>{{$pic->desc}}</p>

    @if( Auth::check() && Auth::user()->id == $trip->user_id)
        <a class="btn btn-default" href="{{url('trip') . '/' . $trip->id . '/entry/'.$entry->id.'/picture/'.$pic->id.'/edit'}}">Edit Picture</a>

        <button class="btn btn-danger confirm" data-confirmation="Are you sure you want to delete this picture?" data-toggle="modal" data-target="#modal-confirm" data-path="{{url('trip') . '/' . $trip->id . '/entry/'.$entry->id.'/picture/'.$pic->id.'/delete'}}">Delete Picture</button>

    @endif

@stop