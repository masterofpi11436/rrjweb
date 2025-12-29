<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Approved</title>
</head>
<body>
    <h2>Hello {{ $supervisor->first_name}},</h2>

    <p>Your order was approved by the warehouse for the section <strong>{{ $section }}</strong></p>

    <h3>Order Summary</h3>

    @foreach ($cart as $item)
        <li>{{ $item['name']}} x {{ $item['quantity'] }}</li>
    @endforeach

    @if ($note)
        <h3>Note from Warehouse:</h3>
        <p>{{ $note }}</p>
    @endif

    <p>(DO NOT REPLY TO THIS EMAIL) Please reach out to the warehouse if you have anything concerning your order.</p>

    <p>Thank you</p>
</body>
</html>
