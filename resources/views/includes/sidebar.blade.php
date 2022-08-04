<aside class="d-none d-lg-block">
    <div class="logo">
        <a href="/">Idea<strong>tax</strong></a>
    </div>
    <div class="menu_wrapper">
        <nav>
            <ul>
                <li><a class="{{ (request()->is('/') ? " active" : "") }}" href="{{ route('dashboard') }}"><img src="/assets/images/icons/dashboard.png">Dashboard</a></li>
                <li><a class="{{ (request()->is('monthly-report') ? " active" : "") }}" href="{{ route('monthly-report') }}"><img src="/assets/images/icons/list.png">Monthly Report</a></li>
                <li><a class="{{ (request()->is('user*') ? " active" : "") }}" href="{{ route('user.edit', Auth::user()->id) }}"><img src="/assets/images/icons/user.png">User Settings</a></li>
                @can('ADMIN')
                    <li><a href="{{ route('admin-dashboard') }}"><img src="/assets/images/icons/admin.png">Admin Page</a></li>
                @endcan
                <li><a href="#"onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><img src="/assets/images/icons/logout.png">Sign Out</a></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
                </form>
            </ul>
        </nav>
    </div>
</aside>