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

    {{-- Header Section with Theme Toggle --}}
    <header class="header">
        <h1>@yield('heading', 'Admin Dashboard')</h1> {{-- Default Heading --}}

        <!-- Theme Toggle Inside Header -->
        <div class="theme-toggle">
            <label class="switch">
                <input type="checkbox" id="theme-toggle">
                <span class="slider round"></span>
            </label>
            <span class="theme-label">Light/Dark Theme</span>
        </div>
    </header>

    {{-- Login Form Layout --}}
    <form method="POST" action="#">
        @csrf

        <div>
            <label for="email">Email</label>
            <input type="email" name="email" required autofocus>
        </div>
        @if ($errors->has('email_not_found'))
            <div style="color: red;">
                {{ $errors->first('email_not_found') }}
            </div>
        @endif

        <div>
            <label for="password">Password</label>
            <input type="password" name="password" required>
        </div>
        @if ($errors->has('password_incorrect'))
            <div style="color: red;">
                {{ $errors->first('password_incorrect') }}
            </div>
        @endif

        <div>
            <button type="submit">Login</button>
        </div>
    </form>

        @if ($errors->has('email'))
            <div style="color: red;">
                {{ $errors->first('email') }}
            </div>
        @endif

        @if ($errors->has('access_denied'))
            <div style="color: red;">
                {{ $errors->first('access_denied') }}
            </div>
        @endif

        @if ($errors->has('session_timeout'))
            <div style="color: red;">
                {{ $errors->first('access_denied') }}
            </div>
        @endif

        <form action="{{ route('login.forgot') }}">
            @csrf
            <button type="submit">Forgot Password</button>
        </form>

    @yield('content')

    @livewireScripts

    <script src="{{ asset('javascript/theme-switcher.js') }}"></script>
</body>
</html>
