<!DOCTYPE html>
<html>
<head>
    <title>Ticket Expiry Notification</title>
</head>
<body>
    <p>Dear Aqeel</p>
    <p>The following tickets have not been Completed and are older than 3 days:</p>
    <ul>
        @foreach($tickets as $ticket)
            <li>Ticket ID: {{ $ticket->ticketid }} - Created At: {{ $ticket->created_at }}</li>
        @endforeach
    </ul>
    <p>Please take the necessary action.</p>
    <p>Best regards,<br>Your Support Team</p>
</body>
</html>
