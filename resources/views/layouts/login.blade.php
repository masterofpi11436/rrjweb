<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/water-dark.css') }}" id="theme-link" >
    <link rel="stylesheet" href="{{ asset('css/common-styles.css') }}">
    <title>@yield('title', 'RRJ Web Applications')</title> <!-- Default title -->
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
    <div class="login-container">
        <div class="login-section">
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
        </div>

        <!-- Separator Line -->
        <div class="separator"></div>

        <!-- Dynamic Content Section -->
        <div class="login-section forgot-google-section">
            @yield('content')
        </div>

    </div>

    <script src="{{ asset('javascript/theme-switcher.js') }}"></script>
</body>
</html>
