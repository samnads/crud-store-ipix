<!DOCTYPE html>
<html lang="en">

<head>
    <title>CRUD - @yield('title', 'Default')</title>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="description">
    <meta content="" name="keywords">
    @include('includes.entry.head-assets')
</head>

<body class="{{ @$body_css_class }}">
    @yield('content')
    @include('includes.entry.footer-assets')
    @stack('footer-assets')
</body>

</html>