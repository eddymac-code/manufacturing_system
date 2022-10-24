<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ManApp</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'], "defer")
</head>
<body class="bg-gray-100">
    <nav class="flex justify-between p-6 bg-gradient-to-r from-sky-500 to-indigo-500 border-b-4 border-indigo-500">
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
                <button class="font-medium px-5 text-white inline" onclick="dropFunction()">{{ auth()->user()->name }} <i id="ddarrow" class="fa-solid fa-caret-right"></i></button>
                <div id="ddMenu" class="absolute bg-white text-blue-500 min-w-160 shadow-sm z-10 mt-6 hidden">
                    <a href="" class="ddcontent font-medium py-2 border-b-2 border-blue-500 px-5 block no-underline hover:bg-slate-500 hover:text-white">Profile</a>
                    <a href="" class="ddcontent font-medium py-2 border-b-2 border-blue-500 px-5 block no-underline hover:bg-slate-500 hover:text-white">Settings</a>
                    <a href="{{ route('logout') }}" class="ddcontent font-medium py-2 border-b-2 border-blue-500 px-5 block no-underline hover:bg-slate-500 hover:text-white" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
    @include('user_menu.left')
    <div class="inline-block">
        @yield('content')
    </div>
    
    <script>
        function dropFunction() {
            let dropmenu = $('#ddMenu');
            let droparrow = $('#ddarrow')
            if (dropmenu.css("display") == "none") {
                dropmenu.show();
                droparrow.removeClass("fa-solid fa-caret-right")
                droparrow.addClass("fa-solid fa-caret-down")
            }else{
                dropmenu.hide();
                droparrow.removeClass("fa-solid fa-caret-down")
                droparrow.addClass("fa-solid fa-caret-right")
            }
        }

        function expand() {
            let arrow = $(".menu-arrow")
            let content = $(".content-menu")

            if (content.css("display") == "none") {
                arrow.removeClass("fa-caret-right")
                arrow.addClass("fa-caret-down")
                content.show()
            } else {
                arrow.removeClass("fa-caret-down")
                arrow.addClass("fa-caret-right")
                content.hide()
            }
        }
    </script>
</body>
</html>