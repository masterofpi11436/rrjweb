<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <link rel="stylesheet" href="{{ asset('css/water-dark.css') }}" id="theme-link" >
    <link rel="stylesheet" href="{{ asset('css/common-styles.css') }}">
    <title>@yield('title', 'RRJ Web Applications')</title> <!-- Default title -->
    @livewireStyles
</head>
<body>

    <!-- Header Section with Theme Toggle -->
    <header class="header">
        <h1>@yield('heading')</h1>

        <!-- Theme Toggle Inside Header -->
        <div class="theme-toggle">
            <label class="switch">
                <input type="checkbox" id="theme-toggle">
                <span class="slider round"></span>
            </label>
            <span class="theme-label">Light/Dark Theme</span>
        </div>
    </header>

    <a href="#" id="back-to-top" class="back-to-top">⬆️ Back to Top</a>

    @yield('content')

    @livewireScripts

    <script src="{{ asset('javascript/theme-switcher.js') }}"></script>
    <script src="{{ asset('javascript/flash-message-expiry.js') }}"></script>
    <script src="{{ asset('javascript/delete-confirmation.js') }}"></script>
    <script src="{{ asset('javascript/back-to-top.js') }}"></script>
</body>
</html>