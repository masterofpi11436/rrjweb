<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <link rel="stylesheet" href="{{ asset('css/water-dark.css') }}" id="theme-link" >
    <link rel="stylesheet" href="{{ asset('css/common-styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/phone-directory/styles.css') }}">
    <title>@yield('title', 'RRJ Web Applications')</title>
    @livewireStyles
</head>
<body>

    <h1>@yield('heading')</h1>

    <div class="theme-toggle">
        <!-- The toggle switch -->
        <label class="switch">
            <input type="checkbox" id="theme-toggle">
            <span class="slider round"></span>
        </label>

        <!-- The label for the theme toggle -->
        <span class="theme-label">Light/Dark Theme</span>
    </div>

    @yield('content')

    @livewireScripts

    <script src="{{ asset('javascript/theme-switcher.js') }}"></script>
</body>
</html>