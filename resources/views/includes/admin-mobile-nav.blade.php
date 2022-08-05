<nav class="navbar_mobile d-block d-lg-none">
	<div class="container-fluid">
		<ul class="navbar_mobile_list">
			<li>
				<a href="{{ route('admin-dashboard') }}" class="d-flex flex-column align-items-center justify-content-center navbar_mobile_link">
					<img src="/assets/images/icons/overview.png" alt="">
					<span>Overview</span>
				</a>
			</li>
			<li>
				<a href="{{ route('admin-report') }}" class="d-flex flex-column align-items-center justify-content-center navbar_mobile_link">
					<img src="/assets/images/icons/calendar.png" alt="">
					<span>Report</span>
				</a>
			</li>
			<li>
				<a href="{{ route('user-list') }}" class="d-flex flex-column align-items-center justify-content-center navbar_mobile_link">
					<img src="/assets/images/icons/userlist.png" alt="">
					<span>Users</span>
				</a>
			</li>
			@can('ADMIN')
				<li>
					<a href="{{ route('dashboard') }}" class="d-flex flex-column align-items-center justify-content-center navbar_mobile_link">
						<img src="/assets/images/icons/admin.png" alt="">
						<span>User Page</span>
					</a>
				</li>
			@endcan
		</ul>
	</div>
</nav>