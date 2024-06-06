@extends('layouts.app')

@section('title')
    Following
@endsection

@section('content')
    <div class="container">
        <a href="/users/{{ $user->id }}" class="btn border">Go back</a>
        <h2 class="my-4">List of users {{ $user->name }} follows:</h2>
        @foreach($user->following as $followedUser)
            <div class="mb-2 d-flex align-items-center justify-content-between">
                <div>
                    <img
                        src="{{ Storage::url($followedUser->image) }}"
                        alt="Profile image" class="img-thumbnail"
                        style="width: 150px">
                </div>
                <div>
                    <div class="flex-grow-1 ms-3">
                        <a href="/users/{{ $followedUser->id }}" class="text-decoration-none text-black link-primary">
                            {{ $followedUser->name }}
                        </a>
                    </div>
                </div>
                <div>
                    <form action="{{ route('unfollow', $followedUser) }}"
                          method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Unfollow</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection
