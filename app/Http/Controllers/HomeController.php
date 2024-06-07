<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        if ($search) {
            $posts = Post::where('content', 'like', '%' . $search . '%')
                ->latest()->get();
        }
        else {
            $posts = Post::latest()->get();
        }
        return view('home', [
            'posts' => $posts,
        ]);
    }
}
