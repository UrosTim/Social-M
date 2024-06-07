@extends('layouts.app')

@section('title')
    Home
@endsection

@section('content')
<div class="container">
    <div class="d-flex justify-content-center mb-4">
        <form action="/home" method="get" class="d-flex gap-2 align-items-center">
            <input type="text" name="search" placeholder="Search posts" class="lh-lg rounded">
            <button type="submit" class="btn btn-success">Search</button>
        </form>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="/posts" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <textarea
                            name="content"
                            id="content"
                            required
                            class="w-100 rounded">
                        </textarea>
                        <label for="image">Image: </label>
                        <input type="file" name="image" id="image">
                        <button type="submit" class="btn btn-primary rounded px-3">
                            Post
                        </button>
                    </div>
                </div>
            </form>
            @foreach($posts as $post)
            <div class="card mt-2">
                <div class="card-header">
                    <a href="/users/{{ $post->user->id }}" class="text-decoration-none">
                        :: {{ $post->user->name }} ::
                    </a>
                </div>
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
                <div class="card-footer d-flex justify-content-between">
                    <div class="d-flex align-items-center">
                        {{ $post->created_at }}
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <div class="text-success-emphasis fw-bold text">
                            {{ $post->likes->count() }}
                        </div>
                        @if($post->user_id === auth()->user()->id)
                            <a href="/posts/{{ $post->id }}" class="btn btn-warning">
                                Edit
                            </a>
                        @elseif (auth()->user()->hasLiked($post))
                            <form action="/post/{{ $post->id }}/like" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-dark">Unlike</button>
                            </form>
                        @else
                            <form action="/post/{{ $post->id }}/like" method="post">
                                @csrf
                                <button type="submit" class="btn btn-success">Like</button>
                            </form>
                        @endif
                    </div>
                </div>
                <div class="card-footer">
                    <a href="/posts/{{ $post->id }}" class="text-decoration-none">
                        Comment
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
