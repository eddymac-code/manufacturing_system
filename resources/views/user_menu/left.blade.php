<div class="sidenav-1" id="sidenav-main">
    <a href="{{ route('dashboard') }}"><i class="fa-solid fa-computer"></i> Dashboard <i class="fa-solid fa-caret-right"></i></a>
    <a class="expandable" href="#" onclick="expandNavMenu(this)"><i class="fa-solid fa-building"></i> Branches <i class="menu-arrow fa-solid fa-caret-right"></i></a>
    <div class="content-menu">
        <a href="{{ route('branches') }}">Show Branches</a>
        <a href="{{ route('create-branch') }}">Add Branch</a>
    </div>
    <a href="#"><i class="fa-solid fa-people-group"></i> Clients <i class="fa-solid fa-caret-right"></i></a>
    <a href="#"><i class="fa-solid fa-cash-register"></i> Sales <i class="fa-solid fa-caret-right"></i></a>
    <a href="#"><i class="fa-solid fa-book"></i> Reports <i class="fa-solid fa-caret-right"></i></a>
    <a class="expandable" href="#" onclick="expandNavMenu(this)"><i class="fa-solid fa-users"></i> Users <i class="menu-arrow fa-solid fa-caret-right"></i></a>
    <div class="content-menu">
        <a href="">Go</a>
        <a href="">Go</a>
        <a href="">Go</a>
    </div>
</div>