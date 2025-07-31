<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Exchange Order Received</title>
</head>
<body>
    <h2>Hello {{ $warehouse_manager->first_name}},</h2>

    <p>A new exchange order was submitted. {{ $user->last_name }}, {{ $user->first_name }} submitted an exchange order for section: <strong>{{ $section->section }}</strong></p>

    <p>Please log in to the Warehouse Store to review the exchange order.</p>
</body>
</html>
