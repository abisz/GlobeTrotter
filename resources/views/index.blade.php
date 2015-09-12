@extends('app')

@section('content')

    @if (!$trips->isEmpty())
        <a class="headerContainer" href="{{ url('trip') . '/' . $trips[0]->id }}">
            <img class="header-trip" src="{{url('img') . '/' . $trips[0]->user_id . '/' . $trips[0]->picName}}" >
                <h2>{{ $trips[0]->name }}</h2>
                <p class="descriptionHead">{{ $trips[0]->desc }}</p>

        </a>
    @endif

    @foreach($trips as $key => $trip)
        @if ($key != 0)
            <a class="pictureContainer" href="{{ url('trip') . '/' . $trip->id }}">
                <img class="trip" src="{{url('img') . '/' . $trip->user_id . '/' . $trip->picName}}">
                    <h3>{{$trip->name}}</h3>
                    <p class="description">{{$trip->desc}}</p>
                </img>
            </a>
        @endif
    @endforeach


@stop