<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin - @yield('title', 'Default')</title>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="description">
    <meta content="" name="keywords">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @include('includes.user.head-assets')
    @stack('head-assets')
</head>

<body class="{{ @$body_css_class }}">
    @include('includes.user.header')
    @include('includes.user.sidebar')
    <main id="main" class="main">
        @yield('content')
    </main><!-- End #main -->
    @include('includes.user.footer')
    @include('includes.user.footer-assets')
    @stack('footer-assets')
</body>

</html>