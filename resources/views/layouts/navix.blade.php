<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/water-dark.css') }}" id="theme-link" >
    <link rel="stylesheet" href="/css/common-styles-light.css" id="common-styles-link">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css','resources/js/navix/navix-app.js'])
    @livewireStyles
</head>
<body>

    <!-- Header Section with Theme Toggle -->
    <header class="header">
        <h1>@yield('heading')</h1>
    </header>

    @yield('content')

    @livewireScripts
</body>
</html>
