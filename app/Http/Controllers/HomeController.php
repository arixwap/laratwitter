<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function index()
    {
        $sortBy = 'created_at';
        $sortDirection = 'DESC';
        $posts = Post::orderBy($sortBy, $sortDirection)->get();
        
        foreach ($posts as $post) {
            $post->isAuth = false;
            if($post->user->id == Auth::id()) {
                $post->isAuth = true;
            }
        }

        return view('home', compact('posts'));
    }
}
