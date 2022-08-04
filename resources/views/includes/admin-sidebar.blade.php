<aside class="d-none d-lg-block">
    <div class="logo">
        <a href="/">Idea<strong>tax</strong></a>
    </div>
    <div class="menu_wrapper">
        <nav>
            <ul>
                <li><a class="{{ (request()->is('admin/dashboard') ? " active" : "") }}" href="{{ route('admin-dashboard') }}"><img src="/assets/images/icons/dashboard.png">Dashboard</a></li>
                <li><a class="{{ (request()->is('admin/monthly-report') ? " active" : "") }}" href="{{ route('admin-report') }}"><img src="/assets/images/icons/list.png">Monthly Report</a></li>
                <li><a class="{{ (request()->is('admin/user-list*') ? " active" : "") }}" href="{{ route('user-list') }}"><img src="/assets/images/icons/user.png">User List</a></li>
                @can('ADMIN')
                    <li><a href="{{ route('dashboard') }}"><img src="/assets/images/icons/admin.png">User Page</a></li>
                @endcan
                <li><a href="#"onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><img src="/assets/images/icons/logout.png">Sign Out</a></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
                </form>
            </ul>
        </nav>
    </div>
</aside>