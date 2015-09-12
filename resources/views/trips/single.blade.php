@extends('app')

@section('content')

    <input id="pac-input" class="controls" type="text" placeholder="Search Box">
    <div id="map-canvas"></div>

    <h1>{{ $trip->name }}</h1>
    <p>{{ $trip->desc }}</p>
    <p>from {{ $trip->start->format('d. M Y') }} to {{ $trip->end->format('d. M Y') }}</p>

    @if( Auth::check() && Auth::user()->id == $trip->user_id)
        <div class="btnContainer">
            <a class="btn btn-default" href="{{url('trip') . '/' . $trip->id . '/edit'}}">Edit Trip</a>
            <button class="btn btn-danger confirm" data-confirmation="Are you sure you want to delete this trip?" data-toggle="modal" data-target="#modal-confirm" data-path="{{url('trip') . '/' . $trip->id . '/delete'}}">Delete Trip</button>
        </div>
        <a class="pictureContainer" href="{{url('trip').'/'.$trip->id.'/entry/create'}}">

                <h3>Add new Entry!</h3>

        </a>
    @endif

    @foreach($entries as $entry)

        <a class="pictureContainer" href="{{ url('trip').'/'.$trip->id.'/entry'.'/' . $entry->id }}">
            <img class="picture" src="{{url('img') . '/' . $trip->user_id . '/' . $entry->picName}}">
                <h3>{{$entry->name}}</h3>
                <p class="description">{{$entry->desc}}</p>

        </a>
    @endforeach

@stop