@extends('layouts.app')

@section('title')
    Followers
@endsection

@section('content')
    <div class="container">
        <a href="/users/{{ $user->id }}" class="btn border">Go back</a>
        <h2 class="my-4">List of users who follow {{ $user->name }}:</h2>

        @foreach($user->followers as $follower)
            <div class="mb-2 d-flex align-items-center justify-content-between">
                <div>
                    <img
                        src="{{ Storage::url($follower->image) }}"
                        alt="Profile image" class="img-thumbnail"
                        style="width: 150px">
                </div>
                <div>
                    <div class="flex-grow-1 ms-3">
                        <a href="/users/{{ $follower->id }}" class="text-decoration-none text-black link-primary">
                            {{ $follower->name }}
                        </a>
                    </div>
                </div>
                @if (auth()->user()->isFollowing($follower))
                    <form action="{{ route('unfollow', $follower) }}"
                          method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Unfollow</button>
                    </form>
                @else
                    <form action="{{ route('follow', $follower) }}"
                          method="post">
                        @csrf
                        <button type="submit" class="btn btn-primary">Follow</button>
                    </form>
                @endif
            </div>
        @endforeach
    </div>
@endsection
