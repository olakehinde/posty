<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Mail;
use App\Mail\PostLiked;

class PostLikeController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']);
    }

    public function like(Post $post, Request $request) {
        $post->likes()->create([
            'user_id' => $request->user()->id,
        ]);
        
        Mail::to($post->user)->send(new PostLiked(auth()->user(), $post));

        return back();
    }

    public function unlike(Post $post, Request $request) {
        $request->user()->likes()->where('post_id', $post->id)->delete();

        return back();
    }
}
