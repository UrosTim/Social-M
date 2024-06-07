@extends('layouts.app')

@section('title')
    {{ $user->name }}
@endsection

@section('content')

    <div class="container">
        <div class="mx-auto">
            @if($user->image)
                <div class="d-block">
                    <img
                        src="{{ Storage::url($user->image) }}"
                        alt="Profile image" class="w-25">
                </div>
            @endif
            <h2>{{ $user->name }}</h2>
            <p>{{ $user->email }}</p>
            @if(auth()->id() === $user->id)
                <div class="my-4">
                    <a href="/users/{{ $user->id }}/edit" class="mx-4 text-decoration-none">
                        <button class="btn btn-warning rounded">
                            Edit
                        </button>
                    </a>
                    <a href="/users/{{ $user->id }}/followers" class="text-decoration-none">
                        <button class="btn border border-dark-subtle rounded">
                            Followers
                        </button>
                    </a>
                    <a href="/users/{{ $user->id }}/following" class="mx-4 text-decoration-none">
                        <button class="btn border border-dark-subtle rounded">
                            Following
                        </button>
                    </a>
                </div>
            @else
                @if (auth()->user()->isFollowing($user))
                    <form action="{{ route('unfollow', $user) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Unfollow</button>
                    </form>
                @else
                    <form action="{{ route('follow', $user) }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-primary">Follow</button>
                    </form>
                @endif
            @endif
        </div>
        <div>
            @foreach($posts as $post)
                <div class="card my-4">
                    <div class="card-body">
                        <div class="mx-2">
                            <div>
                                @if($post->image)
                                    <div class="d-block">
                                        <img
                                            src="{{ Storage::url($post->image) }}"
                                            alt="Profile image" class="w-100 border-bottom p-2">
                                    </div>
                                @endif
                            </div>
                            <div>
                                {{ $post->content }}
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        {{ $post->created_at }}
                        @if(auth()->id() === $user->id)
                            <form action="/posts/{{ $post->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    Delete Post
                                </button>
                            </form>
                        @else
                            <div class="d-flex align-items-center gap-3">
                                <div class="text-success-emphasis fw-bold text">
                                    {{ $post->likes->count() }}
                                </div>
                                @if (auth()->user()->hasLiked($post))
                                    <form action="/post/{{ $post->id }}/like" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-warning">Unlike</button>
                                    </form>
                                @else
                                    <form action="/post/{{ $post->id }}/like" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Like</button>
                                    </form>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
