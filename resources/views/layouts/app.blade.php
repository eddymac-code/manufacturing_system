<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ManApp</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <nav class="flex justify-between p-6 bg-gradient-to-r from-sky-500 to-indigo-500 mb-6">
        <ul class="flex items-center">
        @guest
            <li><a href="#" class="font-bold px-3 py-5 text-white">{{ env('APP_NAME') }}</a></li>
        @endguest
        @auth
            <li><a href="" class="font-medium px-3 py-5 text-white">Home</a></li>
            <li><a href="" class="font-medium px-3 py-5 text-white">Contacts</a></li>
            <li><a href="" class="font-medium px-3 py-5 text-white">About</a></li>
            <li><a href="" class="font-medium px-3 py-5 text-white">Others</a></li> 
        @endauth
        </ul>

        <ul class="flex items-center">
            @auth
            <li>
                <a href="" class="font-medium px-3 py-5 text-white" onclick="dropFunction()">{{ auth()->user()->name }}</a>
                <div id="ddMenu" class="absolute bg-white text-blue-500 min-w-160 shadow-sm z-10 mt-6">
                    <a href="" class="font-medium py-2 border-b-2 border-blue-500 px-5 block no-underline">Profile</a>
                    <a href="" class="font-medium py-2 border-b-2 border-blue-500 px-5 block no-underline">Settings</a>
                    <a href="{{ route('logout') }}" class="font-medium py-2 border-b-2 border-blue-500 px-5 block no-underline" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form action="{{ route('logout') }}" method="post" id="logout-form">
                        @csrf
                    </form>
                </div>
            </li>
            @endauth
        </ul>
    </nav>
    @yield('content')
</body>
</html>