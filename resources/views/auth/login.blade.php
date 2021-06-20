@extends('layouts.app')

@section('content')
    <div class="flex pt-4 justify-center">
        <div class="w-4/12 bg-white p-6 rounded-lg"> 
            <p class="mb-2">Enter Login details.</p>
            @if(session()->has('status'))
                <div class="bg-red-500 my-2 p-4 rounded-lg text-white text-center">
                    {{ session('status') }}
                </div>
            @endif
            <form action="{{ route('login') }}" method="post">
                @csrf 
                
                <div class="mb-4">
                    <label for="email" class="sr-only">Email</label>
                    <input type="email" name="email" id="email" placeholder="Enter your email" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('name') border-red-500 @enderror" value="{{ old('email')}}">

                    @error('email')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" name="password" id="password" placeholder="Enter your password" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('password') border-red-500 @enderror" value="">

                    @error('password')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">Login</button>   
                </div>
            </form>
        </div>
    </div>
@endsection