<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function follow(User $user)
    {
        auth()->user()->following()->attach($user);
        return redirect()->back();
    }
    public function unfollow(User $user)
    {
        auth()->user()->following()->detach($user);
        return redirect()->back();
    }
}
