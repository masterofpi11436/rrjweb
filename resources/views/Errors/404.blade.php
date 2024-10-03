<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <link rel="stylesheet" href="{{ asset('css/water-dark.css') }}" id="theme-link" >
    <link rel="stylesheet" href="{{ asset('css/common-styles.css') }}">
</head>
<body>
    <div class="error-container">
        <h1>404 - Page Not Found</h1>
        <p>
            {{ $exception->getMessage() ? : 'Sorry, the page you are looking for could not be found.' }}
        </p>
    </div>
</body>
</html>
