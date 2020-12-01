@extends('layouts.main')

@section('title', "THE task")


@section('content')
    <h2>Bienvenu dans le board {{$task->title}}</h2>
    @foreach ($task->users as $user)
        <p>{{ $user->name }}</p>
    @endforeach
@endsection