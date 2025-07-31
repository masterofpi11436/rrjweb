<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Submission</title>
</head>
<body>
    <h2>Order Supply Request</h2>

    <p><strong>Submitted By:</strong> {{ $user->first_name }} {{ $user->last_name }}</p>
    <p><strong>Section:</strong> {{ $section->section }}</p>

    <h3>Order Items:</h3>
    <table style="width:100%; border-collapse: collapse;" border="1">
        <thead>
            <tr>
                <th style="padding: 5px;">Item</th>
                <th style="padding: 5px;">Quantity</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cart as $item)
                <tr>
                    <td style="padding: 5px;">{{ $item['name'] }}</td>
                    <td style="padding: 5px;">{{ $item['quantity'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p>Please log in to review and approve the order.</p>

</body>
</html>
