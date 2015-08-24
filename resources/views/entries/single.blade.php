@extends('app')

@section('content')



    <div class="header-map">
        <h1>GoogleMaps Implementation</h1>
    </div>

    <h1>{{ $entry->name }}</h1>
    <p>{{ $entry->desc }}</p>
    <p>{{ $entry->date->format('d. M Y')}}</p>

    @if( Auth::check() && Auth::user()->id == $trip->user_id)
        <a class="btn btn-default" href="{{url('trip') . '/' . $trip->id . '/entry/'.$entry->id.'/edit'}}">Edit Entry</a>
        <button class="btn btn-danger confirm" data-confirmation="Are you sure you want to delete this entry?" data-toggle="modal" data-target="#modal-confirm" data-path="{{url('trip') . '/' . $trip->id . '/entry/'.$entry->id.'/delete'}}">Delete Entry</button>

        <a href="{{ url('trip').'/'.$trip->id.'/entry'.'/' . $entry->id . '/picture/create'}}">
            <div class="picture">
                <h3>Add new Picture!</h3>
            </div>
        </a>
    @endif

    @foreach($pics as $pic)

        <a href="{{ url('trip').'/'.$trip->id.'/entry'.'/' . $entry->id . '/picture/' . $pic->id}}" >
            <div class="picture" style="background: url( '{{url('img') . '/' . $trip->user_id . '/' . $pic->filename}} ') no-repeat center center;">
                <h3>{{$pic->title}}</h3>
                <p>{{$pic->desc}}</p>
            </div>
        </a>
    @endforeach

@stop