<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ManApp</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body class="bg-slate-900 text-gray-300">
    <nav class="nav-1">
        <ul class="flex items-center">
        @guest
            <li><a href="#" class="font-bold px-3 py-5 text-white">{{ env('APP_NAME') }}</a></li>
        @endguest
        @auth
        <li>
            <a href="#" class="font-bold px-3 py-5 text-white">
            {{ \App\Models\Setting::where('setting_key', 'company_name')->first()->setting_value }}
            </a>
        </li>
        @endauth
        </ul>

        <ul class="flex items-center">
            @auth
            <li>
                <a href="{{ route('switch-branch') }}" class="font-medium px-3 py-5 text-white">
                Current Branch: {{ \App\Models\Branch::find(session('branch_id'))->name }}
                </a>
            </li>
            <li>
                <button class="font-medium px-5 text-white inline" onclick="dropFunction()">{{ auth()->user()->name }} <i id="ddarrow" class="fa-solid fa-caret-right"></i></button>
                <div id="ddMenu" class="absolute bg-white text-blue-500 min-w-160 shadow-sm z-auto mt-6 hidden">
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
    <div class="md:ml-64">
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

        function expand(id, arrow) {
            let content = $("#"+id)
            let caret = $(`#${arrow}`).children("i").eq(1).attr("class").split(' ')[0] /* gets first class of the second i element which is 
            among children of element with id ${arrow} */
            let sel_arrow = $(`#${arrow} .${caret}`) // Enables only selection of current element's caret

            if (content.css("display") == "none") {
                sel_arrow.removeClass("fa-caret-right")
                sel_arrow.addClass("fa-caret-down")
                content.show()
            } else {
                sel_arrow.removeClass("fa-caret-down")
                sel_arrow.addClass("fa-caret-right")
                content.hide()
            }
        }

        function expandmenu(id) {
            let content = $("#myDrop"+id)
            if (content.css("display") == "none") {
                content.show()
            } else {
                content.hide()
            }
        }

        function assignId() {
            let count = 0;
            $("#sidenav-main > div.content-menu").each(function(){
                $(this).attr('id', 'main-nav-div-'+count)
                count++
            })

            $("#sidenav-main > a.expandable").each(function(){
                $(this).attr('id', 'main-nav-expandable-a-'+count)
                count++
            })

            /* here, div and a elements which are children of #sidenav-main with
            classes of content-menu and expandable respectively are assigned unique ids
            */
        }

        //$(document).ready(assignId);
        window.onload = function(){
            assignId() // assigns unique ids to elements therein
        }

        function expandNavMenu(elem) {
            let id = $(elem).next("div").attr('id')
            let arrow = $(elem).attr('id')
            expand(id, arrow)
        }
    </script>
</body>
</html>