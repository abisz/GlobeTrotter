@extends('app')

@section('content')


    <input id="pac-input" class="controls" type="text" placeholder="Search Box">
    <div id="map-canvas">
    </div>

    <h1>{{ $entry->name }}</h1>
    <p>{{ $entry->desc }}</p>
    <p>{{ $entry->date->format('d. M Y')}}</p>

    @if( Auth::check() && Auth::user()->id == $trip->user_id)

        <div class="btnContainer">
            <a class="btn btn-default" href="{{url('trip') . '/' . $trip->id . '/entry/'.$entry->id.'/edit'}}">Edit Entry</a>
            <button class="btn btn-danger confirm" data-confirmation="Are you sure you want to delete this entry?" data-toggle="modal" data-target="#modal-confirm" data-path="{{url('trip') . '/' . $trip->id . '/entry/'.$entry->id.'/delete'}}">Delete Entry</button>
        </div>
        <a class="pictureContainer" href="{{ url('trip').'/'.$trip->id.'/entry'.'/' . $entry->id . '/picture/create'}}">

                    <h3>Add new Picture!</h3>

        </a>
    @endif

    @foreach($pics as $pic)

        <a class="pictureContainer" href="{{ url('trip').'/'.$trip->id.'/entry'.'/' . $entry->id . '/picture/' . $pic->id}}" >
                <img class="picture" src="{{url('img') . '/' . $trip->user_id . '/' . $pic->filename}}">
                    <h3>{{$pic->title}}</h3>
                    <p class="description">{{$pic->desc}}</p>

        </a>
    @endforeach

@stop