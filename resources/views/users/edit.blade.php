@extends('app')

@section('content')

    <h1>Edit Profile from {{$user->name}}</h1>

    {!! Form::model($user, ['files' => true, 'method' => 'PATCH', 'url' => 'user/' . $user->id . '/update']) !!}

    @include('users.form', ['submitButtonText' => 'Update User'])

    {!! Form::close() !!}

    @include('errors.list')

    <button class="btn btn-danger confirm" data-confirmation="Are you sure you want to delete your profile?" data-toggle="modal" data-target="#modal-confirm" data-path="{{url('user') . '/' . $user->id . '/delete'}}">Delete Profile</button>

@stop