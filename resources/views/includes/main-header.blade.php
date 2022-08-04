<header class="content_header d-flex align-items-center">
    <div class="container">
        <div class="row d-flex align-items-center">
            <div class="col-12 d-flex justify-content-between justify-content-lg-end">
                <a class="navbar-brand d-block d-lg-none" href="/">Idea<strong>tax</strong></a>
                <div class="profile_wrapper d-flex align-items-center">
                    <span class="mx-0 me-3 d-none d-md-block">{{ Auth::user()->name }}</span>
                    <div class="profile_picture" style="background-image: url('{{ asset("storage/" . Auth::user()->photo) }}')"></div>
                </div>
            </div>
        </div>
    </div>
</header>