<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ManApp</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="flex justify-between p-6 bg-gradient-to-r from-sky-500 to-indigo-500 border-b-4 border-indigo-500">
        <ul class="flex items-center">
        @guest
            <li><a href="#" class="font-bold px-3 py-5 text-white">{{ env('APP_NAME') }}</a></li>
        @endguest
        </ul>
    </div>    
    <div class="mt-5">
        @yield('content')
    </div>
</body>
</html>