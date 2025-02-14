<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/water-dark.css') }}" id="theme-link" >
    <link rel="stylesheet" href="/css/common-styles-light.css" id="common-styles-link">
    <title>@yield('title')</title>
</head>
<body>

    {{-- Header Section with Theme Toggle --}}
    <header class="header">
        <h1>@yield('heading')</h1> {{-- Default Heading --}}

        <!-- Theme Toggle Inside Header -->
        <div class="theme-toggle">
            <label class="switch">
                <input type="checkbox" id="theme-toggle">
                <span class="slider round"></span>
            </label>
            <span class="theme-label">Light/Dark Theme</span>
        </div>
    </header>

    @yield('content')

    <script src="{{ asset('javascript/theme-switcher.js') }}"></script>
</body>
</html>
