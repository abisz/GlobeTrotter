@extends('app')

@section('content')

    @if (!$trips->isEmpty())
        <a class="headerContainer" href="{{ url('trip') . '/' . $trips[0]->id }}">
            <img class="header-trip" src="{{url('img') . '/' . $user_id . '/' . $trips[0]->picName}}" >
                <h2>{{ $trips[0]->name }}</h2>
                <p class="descriptionHead">{{ $trips[0]->desc }}</p>

        </a>
    @endif

    @if( Auth::check() && Auth::user()->id == $user_id)
        <a class="pictureContainer" href="{{url('trip/create')}}">

                <h3>Add new Trip!</h3>

        </a>
    @endif

    @foreach($trips as $key => $trip)
        @if ($key != 0)
            <a href="{{ url('trip') . '/' . $trip->id }}">
                <img class="trip" src="{{url('img') . '/' . $user_id . '/' . $trip->picName}}">
                    <h3>{{$trip->name}}</h3>
                    <p class="description">{{$trip->desc}}</p>

            </a>
        @endif
    @endforeach

@stop