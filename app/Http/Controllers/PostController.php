<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{

    public function __construct() {
        $this->middleware(['auth'])->except(['index', 'show']);
    }


    public function index() {
        // dd(Post::get());
        $posts = Post::latest()->with(['user', 'likes'])->paginate(20);

        return view('posts.index', [
            'posts' => $posts,
        ]);
    }

    public function show (Post $post) {
        return view('posts.show')->with('post', $post);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'body' => 'required',
        ]);

        $request->user()->posts()->create([
            'body' => $request->body
        ]);
       // $request->user()->posts()->create($request->only('body'));

        return back();
    }

    public function delete(Post $post) {
        $this->authorize('delete', $post);
        
        $post->delete();

        return back();
    }
}
