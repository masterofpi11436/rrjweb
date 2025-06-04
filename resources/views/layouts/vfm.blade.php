<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/water-dark.css') }}" id="theme-link" >
    <link rel="stylesheet" href="{{ asset('/css/common-styles-dark.css') }}" id="common-styles-link" >
    <link rel="stylesheet" href="{{ asset('/css/vfm-form.css')}}">
    <title>@yield('title')</title>
    @livewireStyles
</head>
<body>

    <!-- Header Section with Theme Toggle -->
    <header class="header">
        <h1>@yield('heading')</h1>

        <div class="header-right">
            <form action="{{ route('vfm.logout') }}" method="POST">
                @csrf
                <button>Logout</button>
            </form>

            <div class="theme-toggle">
                <label class="switch">
                    <input type="checkbox" id="theme-toggle">
                    <span class="slider round"></span>
                </label>
                <span class="theme-label">Light/Dark Theme</span>
            </div>
        </div>

        @if(Auth::user()->admin === 1)
            <form action="{{ route('admin.dashboard') }}">
                <button>Admin Dashboard</button>
            </form>
        @endif
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
