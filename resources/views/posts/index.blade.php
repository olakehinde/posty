@extends('layouts.app')

@section('content')
    <div class="flex pt-4 justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg"> 
            <form action="{{ route('posts') }}" method="post" class="mb-4">
                @csrf
                <div class="mb-4">
                    <label for="body" class="sr-only">Post</label>
                    <textarea name="body" id="body" cols="30" rows="4" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('body') border-red-500 @enderror" placeholder="What's on your mind!"></textarea>

                    @error('body')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div>
                    <button type="submit" class="bg-blue-500 w-3/12 text-white px-4 py-2 rounded font-medium">Post</button>
                </div>
            </form>

            @if ($posts->count())
                @foreach ($posts as $post)
                    <div class="mb-4">
                        <a href="" class="font-bold">{{ $post->user->name }}</a> <span class="text-gray-600 text-sm">{{ $post->created_at->diffForHumans() }}</span>
                        
                        <p class="mb-2">{{ $post->body }}</p>  

                        @if ($post->ownedBy(auth()->user()))
                            <div>
                                <form action="{{ route('posts.delete', $post) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-blue-500">Delete</button>
                                </form>
                            </div>
                        @endif

                        <div class="flex items-center">
                            @auth
                                @if (!$post->likedBy(auth()->user()))
                                    <form action="{{ route('posts.like', $post) }}" method="post" class="mr-1">
                                        @csrf
                                        <button type="submit" class="text-blue-500">Like</button>
                                    </form>
                                @else
                                    <form action="{{ route('posts.like', $post) }}" method="post" class="mr-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-blue-500">Unlike</button>
                                    </form>
                                @endif
                            @endauth

                            <!-- <span> {{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }}</span> -->
                            <span>{{ $post->likes->count() }} {{ ($post->likes->count() > 1 ? 'likes' : 'like') }} </span>
                        </div>                      
                    </div>             
                @endforeach 
                {{ $posts->links() }}
            @else
                <p>No Post created yet.</p>
            @endif

            
        </div>
    </div>
@endsection