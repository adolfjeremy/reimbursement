<aside class="d-none d-lg-block">
    <div class="menu_top">
        <div class="logo_wrapper text-center">
            <h1>Reimbursement</h1>
            <p>by Idea<strong>tax</strong></p>
        </div>
        <span>MENU</span>
        <div class="menu_list">
            <a href="{{ route('admin-dashboard') }}" class="menu_link{{ (request()->is('admin/dashboard') ? " active" : "") }}">
                <img src="/assets/images/icons/overview.png">
                Overview
            </a>
            <a href="{{ route('admin-report') }}" class="menu_link{{ (request()->is('admin/monthly-report') ? " active" : "") }}">
                <img src="/assets/images/icons/calendar.png">
                Monthly Report
            </a>
            <a href="{{ route('user-list') }}" class="menu_link{{ (request()->is('admin/user-list*') ? " active" : "") }}">
                <img src="/assets/images/icons/list.png">
                User List
            </a>
            @can('ADMIN')
            <a href="{{ route('dashboard') }}" class="menu_link">
                <img src="/assets/images/icons/admin.png">
                User Page
            </a>
            @endcan
        </div>
    </div>
    <div class="menu_bottom">
        <span>PROFILE</span>
        <div class="profile_wrapper d-flex align-items-center">
            <div class="profile_picture" style="background-image: url('{{ asset("storage/" . Auth::user()->photo) }}')"></div>
            <p>{{ Auth::user()->name }}</p>
        </div>
        <a href="#" class="menu_link active" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <img src="/assets/images/icons/signout.png">
            Log out
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
        </form>
    </div>
</aside>