<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        if ($search) {
            $users = User::where('name', 'like', '%' . $search . '%')
                ->get()->sortBy('name');
        }
        else {
            $users = User::all()->sortBy('name');
        }

        return view('users.index', [
            'users' => $users,
        ]);
    }
    public function show(User $user)
    {
        $posts = Post::where('user_id', $user->id)->latest()->get();

        return view('users.show', [
            'user' => $user,
            'posts' => $posts,
        ]);
    }
    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user
        ]);
    }
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->fill([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
        }
        $user->image = $imagePath ?? null;

        $user->save();

        return redirect()->route('users.show', ['user' => $user])
            ->with('success', 'You have successfully updated your profile.');
    }
    public function destroy(User $user)
    {
        Auth::logout();
        $user->delete();
        return redirect('login')
            ->with('success', 'You have successfully deleted your profile.');
    }
    public function following(User $user)
    {
        return view('users.following', [
            'user' => $user
        ]);
    }
    public function followers(User $user)
    {
        return view('users.followers', [
            'user' => $user
        ]);
    }
}
