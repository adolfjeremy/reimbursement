<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') | Ideatax Expense Tracker</title>
    @include('includes.styles')
</head>
<body>
    @include('includes.mobile-nav')
    @include('includes.sidebar')
    <main>
        @include('includes.main-header')
        @yield('content')
    </main>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"></script>
    <script src="/assets/vendor/bootstrap-5.2.0-beta1-dist/js/bootstrap.min.js"></script>
</body>
</html>