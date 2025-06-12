<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Hello {{ $warehouse_manager->first_name}},</h2>

    <p>A new order was received. {{ $user->last_name }}, {{ $user->first_name }} submitted an order for section: <strong>{{ $section->section }}</strong></p>

    <p>Thank you</p>
</body>
</html>
