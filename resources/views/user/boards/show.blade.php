@extends('layouts.main')

@section('title', "User's board {{$board->title}}")


@section('content')
    <h2>{{$board->title}}<h2>
    <p>{{$board->description}}</p>
    <div class="participants">
        @foreach($board->users as $user) 
            <p>{{$user->name}}</p>
        @endforeach
    </div>

@endsection