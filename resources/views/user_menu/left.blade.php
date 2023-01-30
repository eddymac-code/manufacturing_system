<div class="sidenav-1 font-bold bg-slate-900 text-gray-300" id="sidenav-main">
    <a href="{{ route('dashboard') }}"><i class="fa-solid fa-computer"></i> Dashboard <i class="fa-solid fa-caret-right"></i></a>
    <a class="expandable" href="#" onclick="expandNavMenu(this)"><i class="fa-solid fa-building"></i> Branches <i class="menu-arrow fa-solid fa-caret-right"></i></a>
    <div class="content-menu">
        @if (auth()->user()->hasPermissionTo('View Branches'))
            <a href="{{ route('branches') }}">Show Branches</a>
        @endif
        @if (auth()->user()->hasPermissionTo('Create Branches'))
            <a href="{{ route('create-branch') }}">Add Branch</a>
        @endif
    </div> <!-- Here -->
    <a class="expandable" href="#" onclick="expandNavMenu(this)"><i class="fa-solid fa-people-group"></i> Clients <i class="menu-arrow fa-solid fa-caret-right"></i></a>
        <div class="content-menu">
            @if (auth()->user()->hasPermissionTo('View Clients'))
                <a href="{{ route('clients') }}">Show Clients</a>
            @endif
            @if (auth()->user()->hasPermissionTo('Create Clients'))
                <a href="{{ route('create-client') }}">Add Client</a>
            @endif
        </div>
    <a class="expandable" href="#" onclick="expandNavMenu(this)"><i class="fa-solid fa-cash-register"></i> Sales <i class="menu-arrow fa-solid fa-caret-right"></i></a>
    <div class="content-menu">
        @if (auth()->user()->hasPermissionTo('View Sales'))
            <a href="">Show Sales</a>
        @endif
        @if (auth()->user()->hasPermissionTo('Create Sales'))
            <a href="">Add Sale</a>
        @endif
    </div>
    <a href="#"><i class="fa-solid fa-book"></i> Reports <i class="fa-solid fa-caret-right"></i></a>
    <a class="expandable" href="#" onclick="expandNavMenu(this)"><i class="fa-solid fa-users"></i> Users <i class="menu-arrow fa-solid fa-caret-right"></i></a>
    <div class="content-menu">
        @if (auth()->user()->hasPermissionTo('View Users'))
            <a href="{{ route('users') }}">Show Users</a>
        @endif
        @if (auth()->user()->hasPermissionTo('Create Users'))
            <a href="{{ route('roles') }}">Roles</a>
        @endif
        @if (auth()->user()->hasPermissionTo('Create Users'))
            <a href="{{ route('permissions') }}">Permissions</a>
        @endif
    </div>
    <a class="expandable" href="#" onclick="expandNavMenu(this)"><i class="fa-solid fa-gear"></i> Settings <i class="menu-arrow fa-solid fa-caret-right"></i></a>
    <div class="content-menu">
        @if (auth()->user()->hasPermissionTo('View Settings'))
            <a href="{{ route('show-settings') }}">Show Settings</a>
        @endif
    </div>
</div>