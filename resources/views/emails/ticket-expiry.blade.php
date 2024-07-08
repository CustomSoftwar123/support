<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Expiry Notification</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <p>Dear {{$users}},</p>
    <p>Resolution Time for the Following ticktes has expired.</p>
    <table>
        <thead>
            <tr>
                <th>Ticket ID</th>
                <th>Subject</th>
                <th>Created By</th>
                <th>Assigned To</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->ticketid }}</td>
                    <td>{{ $ticket->subject }}</td>
                    <td>{{ $ticket->username }}</td>
                    <td>{{ $ticket->assignedto?: 'Never assigned' }}</td>
                    <td>{{\App\Http\Controllers\tickets::DateTime($ticket->created_at)}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <p>Please take the necessary action.</p>
    <p>Best regards,<br>Your Support Team</p>
</body>
</html>
