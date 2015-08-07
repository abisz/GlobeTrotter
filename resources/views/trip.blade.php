@extends('app')

@section('content')

    <h1>{{$trip->name}}</h1>
    <div class="meta">from {{ $trip->start }} to {{ $trip->end }}</div>

    <div class="body"> {{$trip->desc }} </div>

@stop