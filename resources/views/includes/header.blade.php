<header class="content_header d-flex align-items-center d-block d-lg-none">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 d-flex align-items-center justify-content-between">
                <div class="profile_wrapper d-flex align-items-center">
                    <div class="profile_picture" style="background-image: url('{{ asset("storage/" . Auth::user()->photo) }}')"></div>
                    <p class="d-none d-md-block d-lg-none m-0 ms-2">{{ Auth::user()->name }}</p>
                </div>
                <a href="#" class="d-flex flex-column align-items-center justify-content-center navbar_mobile_link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <img src="/assets/images/icons/logout.png" alt="">
                    <span style="color: #1b1c1e; font-weight:500;">Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</header>