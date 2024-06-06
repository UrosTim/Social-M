@extends('layouts.app')

@section('title')
    Home
@endsection

@section('content')
<div class="container">
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
                <div class="card-footer">
                    {{ $post->created_at }}
                </div>
{{--                <div class="card-footer">--}}
{{--                    Comment--}}
{{--                </div>--}}
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
