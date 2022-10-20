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
    <nav class="flex justify-center space-x-4 bg-gradient-to-r from-sky-500 to-indigo-500 mb-6">
        @guest
            <a href="#" class="font-bold px-3 py-5 text-white">{{ env('APP_NAME') }}</a>
        @endguest
        @auth
            <a href="" class="font-medium px-3 py-5 text-white">Home</a>
            <a href="" class="font-medium px-3 py-5 text-white">Contacts</a>
            <a href="" class="font-medium px-3 py-5 text-white">About</a>
            <a href="" class="font-medium px-3 py-5 text-white">Others</a> 
        @endauth
        
    </nav>
    @yield('content')
</body>
</html>