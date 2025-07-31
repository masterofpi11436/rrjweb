<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exchange Order Submitted</title>
</head>
<body>
    <h2>Hello {{ $user->first_name}} {{ $user->last_name}},</h2>

    <p>Your exchange order was successfully submitted to the warehouse for the section: {{ $section->section }}</p>

    <p>You MUST take the item(s) to the warehouse in order to complete the order.</p>

    <p>The warehouse will deny your order if you or somone else in your section does not bring the items to the warehouse.</p>

    <p>If you have any questions, please contact the warehouse team.</p>

    <p>Thank you!</p>
</body>
</html>
