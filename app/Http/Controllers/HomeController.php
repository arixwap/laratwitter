<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

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
        $sortBy = 'posts.created_at';
        $sortDirection = 'DESC';
        $posts = Post::join('users', 'posts.id_user', '=', 'users.id')
            ->where('posts.show_post', '=', '1')
            ->orderBy($sortBy, $sortDirection)->get();
        return view('home', compact('posts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'content'=>'required'
        ]);
        $post = new Post([
            'content' => $request->get('content'),
            'id_user'=> Auth::user()->id,
            'show_post'=> 1,
            'id_first_post' => 0,
            'id_parent_post' => 0
        ]);
        $post->save();
        return redirect('/')->with('success', 'Post success');
    }
}
