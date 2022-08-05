<nav class="navbar_mobile d-block d-lg-none">
	<div class="container-fluid">
		<ul class="navbar_mobile_list">
			<li>
				<a href="{{ route('dashboard') }}" class="d-flex flex-column align-items-center justify-content-center navbar_mobile_link">
					<img src="/assets/images/icons/overview.png" alt="">
					<span>Overview</span>
				</a>
			</li>
			<li>
				<a href="{{ route('monthly-report') }}" class="d-flex flex-column align-items-center justify-content-center navbar_mobile_link">
					<img src="/assets/images/icons/calendar.png" alt="">
					<span>Report</span>
				</a>
			</li>
			<li>
				<a type="button" class="d-flex flex-column align-items-center justify-content-center navbar_mobile_link" data-bs-toggle="modal" data-bs-target="#exampleModal">
					<img src="/assets/images/icons/add.png" alt="">
					<span>Add</span>
				</a>
			</li>
			<li>
				<a href="{{ route('user.edit', Auth::user()->id) }}" class="d-flex flex-column align-items-center justify-content-center navbar_mobile_link">
					<img src="/assets/images/icons/settings.png" alt="">
					<span>Account</span>
				</a>
			</li>
			@can('ADMIN')
				<li>
					<a href="{{ route('admin-dashboard') }}" class="d-flex flex-column align-items-center justify-content-center navbar_mobile_link">
						<img src="/assets/images/icons/admin.png" alt="">
						<span>Admin</span>
					</a>
				</li>
			@endcan
		</ul>
	</div>
</nav>