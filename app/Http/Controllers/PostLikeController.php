<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostLikeController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']);
    }

    public function like(Post $post, Request $request) {
        $post->likes()->create([
            'user_id' => $request->user()->id,
        ]);

        return back();
    }

    public function unlike(Post $post, Request $request) {
        $request->user()->likes()->where('post_id', $post->id)->delete();

        return back();
    }
}
