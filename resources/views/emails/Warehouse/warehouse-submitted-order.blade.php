<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Order Received</title>
</head>
<body>
    <h2>Hello {{ $supervisor->first_name }},</h2>

    <p>The warehouse has submitted the following order on your behalf for the <strong>{{ $section->section }}</strong> section.</p>

    <h3>Order Summary</h3>
    <ul>
        @foreach ($cart as $item)
            <li>{{ $item['name'] }} x {{ $item['quantity'] }}</li>
        @endforeach
    </ul>

    <p>Thank you,</p>
</body>
</html>
