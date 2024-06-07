@extends('layouts.app')

@section('title')
    List of Users
@endsection

@section('content')
    <div class="container">
        <div class="d-flex justify-content-center">
            <form action="/users" method="get" class="d-flex gap-2 align-items-center">
                <input type="text" name="search" placeholder="Search users" class="lh-lg rounded">
                <button type="submit" class="btn btn-success">Search</button>
            </form>
        </div>
        @foreach($users as $user)
            <div class="mb-2 d-flex align-items-center justify-content-between">
                <div>
                    <img
                        src="{{ Storage::url($user->image) }}"
                        alt="Profile image" class="img-thumbnail"
                        style="width: 150px">
                </div>
                <div>
                    <div class="flex-grow-1 ms-3">
                        <a href="/users/{{ $user->id }}" class="text-decoration-none text-black link-primary">
                            {{ $user->name }}
                        </a>
                    </div>
                </div>
                <div>
                    @if(auth()->id() !== $user->id)
                        @if (auth()->user()->isFollowing($user))
                            <form action="{{ route('unfollow', $user) }}"
                                  method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Unfollow</button>
                            </form>
                        @else
                            <form action="{{ route('follow', $user) }}"
                                  method="post">
                                @csrf
                                <button type="submit" class="btn btn-primary">Follow</button>
                            </form>
                        @endif
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endsection
