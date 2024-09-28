<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <link id="theme-link" rel="stylesheet" href="{{ asset('css/water-dark.css') }}">    
    <title>@yield('title', 'RRJ Web Applications')</title>
    @livewireStyles
</head>
<body>

    <h1>@yield('heading')</h1>

    <button id="theme-toggle">Switch Theme</button>

    @yield('content')

    @livewireScripts

    <script src="{{ asset('javascript/theme-switcher.js') }}"></script>
</body>
</html>
