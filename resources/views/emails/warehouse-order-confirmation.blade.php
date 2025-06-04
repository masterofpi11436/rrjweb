<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Hello {{ $user->first_name}},</h2>

    <p>Your order was successfully submitted to the warehouse for the section <strong>{{ $section->section }}</strong></p>

    <h3>Order Summary</h3>

    @foreach ($cart as $item)
        <li>{{ $item-['name']}} - {{ $item['quantity'] }}</li>
    @endforeach

    <p>Please reach out to the warehouse if you have anything concerning your order.</p>

    <p>Thank you</p>
</body>
</html>
