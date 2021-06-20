<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posty</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="bg-gray-200">
    <nav class="p-6 bg-white flex justify-between">
        <ul class="flex items-center">
            <li> 
                <a href="" class="p-3">Home</a>
            </li> 

            @auth
                <li> 
                    <a href="{{ route('dashboard') }}" class="p-3">Dashboard</a>
                </li>
                <li> 
                    <a href="" class="p-3">Posts</a>
                </li>
            @endauth
        </ul>

        <ul class="flex items-center">
        @auth
            <li> 
                <a href="" class="p-3">Olamide Kehinde </a>
            </li> 
            <li> 
                <a href="" class="p-3">Logout</a>
            </li>
        @endauth

        @guest
            <li> 
                <a href="{{ route('register') }}" class="p-3">Register</a>
            </li>
            <li> 
                <a href="" class="p-3">Login</a>
            </li>
        @endguest
        </ul>

    </nav>


    @yield('content')
</body>
</html>