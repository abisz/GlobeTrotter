@extends('app')

@section('content')

    <h1>Trips:</h1>

    @foreach ($trips as $trip)
        <article>
            
            <h2>
                <a href="{{ action('TripsController@show', [$trip->id]) }}">
                    {{ $trip->name }}
                </a>
            </h2>

            <div class="meta">from {{ $trip->start }} to {{ $trip->end }}</div>

            <div class="body"> {{$trip->desc }} </div>
        </article>
    @endforeach

@stop