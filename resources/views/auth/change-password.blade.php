@extends('layouts.app')

@section('title')
    Change Password
@endsection

@section('content')
    <div class="container">
        <form action="/auth/change-password" method="post" class="d-block">
            @csrf
            @method('PATCH')
            <label for="current_password" class="d-block my-2">Old Password</label>
            <input class="d-block" type="password" name="current_password" id="current_password">
            @error('current_password')
            <span class="d-block">{{ $message }}</span>
            @enderror

            <label for="password" class="d-block my-2">New Password</label>
            <input class="d-block" type="password" name="password" id="password">
            @error('password')
            <span class="d-block">{{ $message }}</span>
            @enderror

            <label for="password_confirmation" class="d-block my-2">Confirm New Password</label>
            <input class="d-block" type="password" name="password_confirmation" id="password_confirmation">
            @error('password_confirmation')
            <span class="d-block">{{ $message }}</span>
            @enderror

            <button class="d-block my-2 btn btn-success" type="submit">Change Password</button>
        </form>

    </div>
@endsection
