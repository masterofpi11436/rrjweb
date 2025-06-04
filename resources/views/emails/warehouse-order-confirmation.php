<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Hello {{ $user->first_name }},</h2>

    <p>Your order for the <strong>{{ $section->section }}</strong> section has been submitted to the warehouse.</p>

    <h3>Order Summary:</h3>
    <ul>
        @foreach ($cart as $item)
            <li>{{ $item['name'] }} — {{ $item['quantity'] }}</li>
        @endforeach
    </ul>

    <p>Thank you!</p>
</body>
</html>
