@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="/users/{{ $user->id }}" class="btn border">Go back</a>
        <h2 class="my-4">List of users who follow {{ $user->name }}:</h2>
        <ul>
            @foreach ($user->followers as $follower)
                <li>
                    <a href="/users/{{ $follower->id }}" class="text-decoration-none">
                        {{ $follower->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
