<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use App\Post;
use App\Repositories\Posts;

class PostsController extends Controller
{
    public function __construct()
    {
        //$this->middleware('Auth')->except(['index', 'show']);
    }

    public function index(Tag $tag = null)
    {
        $message = session('message');
        $posts = Post::latest()
            ->filter(request(['month', 'year']))
            ->get();

        $archives = Post::archives();

        return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        $this->validate(request(), [
            'title' => 'required',
            'body' => 'required'
        ]);

        auth()->user()->publish(new Post(request(['title', 'body'])));

        session()->flash('message', 'Your post has been published.');

        return redirect('/');
    }
}
