@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="/users/{{ $user->id }}" class="btn border">Go back</a>
        <h2 class="my-4">List of users {{ $user->name }} follows:</h2>
        <ul>
            @foreach ($user->following as $followedUser)
                <li>
                    <a href="/users/{{ $followedUser->id }}" class="text-decoration-none">
                        {{ $followedUser->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
