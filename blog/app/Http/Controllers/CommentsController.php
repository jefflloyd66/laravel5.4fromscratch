<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Post;

class CommentsController extends Controller
{
    public function store(Post $post)
    {
        $this->validate(request(), ['body' => 'required|min:2']);

        $post->addComment([
            'body' => request('body'),
            'user_id' => auth()->user()->id,
            'post_id' => $post->id
        ]);

        return back();
    }
}
