<nav class="navbar_mobile d-block d-lg-none">
	<div class="container-fluid">
		<ul class="navbar_mobile_list">
			<li>
				<a href="{{ route('dashboard') }}" class="d-flex flex-column align-items-center justify-content-center navbar_mobile_link">
					<img src="/assets/images/icons/mobile/home.png" alt="">
					<span>Beranda</span>
				</a>
			</li>
			<li>
				<a href="{{ route('monthly-report') }}" class="d-flex flex-column align-items-center justify-content-center navbar_mobile_link">
					<img src="/assets/images/icons/mobile/month.png" alt="">
					<span>Report</span>
				</a>
			</li>
			@can('ADMIN')
				<li>
					<a href="{{ route('admin-dashboard') }}" class="d-flex flex-column align-items-center justify-content-center navbar_mobile_link">
						<img src="/assets/images/icons/mobile/admin.png" alt="">
						<span>Admin</span>
					</a>
				</li>
			@endcan
			<li>
				<a href="{{ route('user.edit', Auth::user()->id) }}" class="d-flex flex-column align-items-center justify-content-center navbar_mobile_link">
					<img src="/assets/images/icons/mobile/user.png" alt="">
					<span>Profile</span>
				</a>
			</li>
			<li>
				<a href="#" class="d-flex flex-column align-items-center justify-content-center navbar_mobile_link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
					<img src="/assets/images/icons/mobile/logout.png" alt="">
					<span>Logout</span>
				</a>
				<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
                </form>
			</li>
		</ul>
	</div>
</nav>