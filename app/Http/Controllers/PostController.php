<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $post = new Post();
        $imagePath = $request->file('image')->store('images', 'public');

        $post->fill([
            'content' => $request->input('content'),
            'user_id' => request()->user()->id,
            'image' => $imagePath ?? null,
        ]);
        $post->save();

        return redirect('/home');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $comments = Comment::where('post_id', $post->id)->get();
        return view('posts.show', [
            'post' => $post,
            'comments' => $comments,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()
            ->route('users.show', ['user' => Auth::user()])
            ->with('success', 'Post has been deleted');
    }
    public function like(Post $post)
    {
        $post->likes()->create([
            'user_id' => auth()->id(),
        ]);
        return back();
    }
    public function unlike(Post $post)
    {
        $post->likes()->where('user_id', auth()->id())->delete();
        return back();
    }
    public function addComment(Post $post)
    {
        $post->comments()->create([
            'user_id' => auth()->id(),
            'body' => request('body'),
        ]);
        return back();
    }
}
