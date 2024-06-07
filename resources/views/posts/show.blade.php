@extends('layouts.app')

@section('title')
    Post: {{ $post->id }}
@endsection

@section('content')
    <div class="container">
        <div class="d-block">
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
                </div>
                <div class="card-footer">
                    <form action="/post/{{ $post->id }}/comment" method="post" class="d-flex align-items-center justify-content-between">
                        @csrf
                        <textarea name="body" class="w-75" rows="3"></textarea>
                        <button type="submit" class="btn btn-light border border-dark">Add Comment</button>
                    </form>
                </div>
                @foreach($comments as $comment)
                    <div class="card-footer d-flex gap-3 justify-content-between">
                        <div class="d-flex align-items-start">
                            <img
                                src="{{ Storage::url($post->user->image) }}"
                                alt="Profile image"
                                style="width: 50px">
                        </div>
                        <div class="d-flex flex-column justify-content-center w-100">
                            <div>
                                <a href="/users/{{ $comment->user_id }}" class="text-decoration-none">
                                    {{ $comment->user->name }}
                                </a>
                            </div>
                            <div>
                                {{ $comment->body }}
                            </div>
                        </div>
                        <div class="d-flex align-items-baseline">
                            @if($comment->user_id === auth()->user()->id)
                                <form action="/comment/{{ $comment->id }}"
                                      method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
