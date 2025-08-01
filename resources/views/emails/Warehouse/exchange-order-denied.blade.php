<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exchange Order Denied</title>
</head>
<body>
    <h2>Hello {{ $user->first_name}} {{ $user->last_name}},</h2>

    <p>Your exchange order was successfully submitted to the warehouse for the section: {{ $section->section }}</p>

    <p>Your Exchange order was denied for the following reason:</p>
    <p>{{ $note}} </p>

    <p>Thank you!</p>
</body>
</html>
