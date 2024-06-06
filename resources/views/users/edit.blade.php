@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="/users/{{ $user->id }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="d-block">
                @if($user->image)
                    <div class="d-block">
                        <img
                            src="{{ Storage::url($user->image) }}"
                            alt="Profile image" class="w-25">
                    </div>
                @endif
                <div class="my-2">
                    <h2>
                        Edit Profile
                    </h2>
                </div>
                <div class="my-2">
                    <label for="name" class="d-block">
                        Name :
                    </label>
                    <input type="text" name="name" id="name" value="{{ $user->name }}" class="rounded">
                </div>
                <div class="my-2">
                    <label for="email" class="d-block">
                        Email :
                    </label>
                    <input type="email" name="email" id="email" value="{{ $user->email }}" class="rounded">
                </div>
                <div class="my-2">
                    <label for="image">
                        Image :
                    </label>
                    <div>
                        <input name="image" id="image" type="file">
                    </div>
                </div>
                <div class="my-4">
                    <button type="submit" class="btn btn-primary rounded px-2 py-1">
                        Update
                    </button>
                    <a href="/users/{{ $user->id }}" class="text-decoration-none btn">
                        Cancel
                    </a>
                </div>
            </div>
        </form>
    </div>
@endsection
