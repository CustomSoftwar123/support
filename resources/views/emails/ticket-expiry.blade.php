<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Expiry Notification</title>
</head>
<body>
    <p>Dear User,</p>
    @foreach ($ticketIds as $ticketId)
        <p>The response time for ticket ID {{ $ticketId }} has expired.</p>
    @endforeach
    <p>Please take the necessary action.</p>
    <p>Best regards,<br>Your Support Team</p>
</body>
</html>
