@extends('app')

@section('content')

    <h1>Edit Profile from {{$user->name}}</h1>

    {!! Form::model($user, ['files' => true, 'method' => 'PATCH', 'url' => 'user/' . $user->id . '/update']) !!}

    @include('users.form', ['submitButtonText' => 'Update User'])

    {!! Form::close() !!}

    @include('errors.list')

    <a class="btn btn-danger" href="{{url('user') . '/' . $user->id . '/delete'}}">Delete Profile</a>

@stop