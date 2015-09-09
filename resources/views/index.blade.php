@extends('app')

@section('content')

    @if (!$trips->isEmpty())
        <a href="{{ url('trip') . '/' . $trips[0]->id }}">
            <div class="header-trip" style="background: url( '{{url('img') . '/' . $trips[0]->user_id . '/' . $trips[0]->picName}} ') no-repeat center center;" >
                <h2>{{ $trips[0]->name }}</h2>
                <p>{{ $trips[0]->desc }}</p>
            </div>
        </a>
    @endif

    @foreach($trips as $key => $trip)
        @if ($key != 0)
            <a href="{{ url('trip') . '/' . $trip->id }}">
                <div class="trip" style="background: url( '{{url('img') . '/' . $trip->user_id . '/' . $trip->picName}} ') no-repeat center center;">
                    <h3>{{$trip->name}}</h3>
                    <p>{{$trip->desc}}</p>
                </div>
            </a>
        @endif
    @endforeach


@stop