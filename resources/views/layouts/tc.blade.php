<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body>

    <!-- Header Section with Theme Toggle -->


    <a href="#" id="back-to-top" class="back-to-top">⬆️ Back to Top</a>

    @yield('content')

    @livewireScripts

    <script src="{{ asset('javascript/theme-switcher.js') }}"></script>
    <script src="{{ asset('javascript/flash-message-expiry.js') }}"></script>
    <script src="{{ asset('javascript/delete-confirmation.js') }}"></script>
    <script src="{{ asset('javascript/back-to-top.js') }}"></script>
</body>

</html>
