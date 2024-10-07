<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        h3 {
            color: #666;
            margin-top: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        tr:hover {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Ticket Notification</h2>

        @foreach($tickets as $priority => $ticketsGroup)
            <h3>{{ $priority }} Priority</h3>

            <table>
                <thead>
                    <tr>
                        <th>Ticket Number</th>
                        <th>Status</th>
                        <th>Remaining Response Time (hours)</th>
                        <th>Remaining Resolution Time (hours)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ticketsGroup as $ticketData)
                    @php
                        $createdAt = \Carbon\Carbon::parse($ticketData['ticket']->created_at);
                        $now = \Carbon\Carbon::now();
                        $responseDeadline = $createdAt->copy()->addHours($ticketData['responseTime']);
                        $remainingTimeToReply = ($responseDeadline->gt($now)) ? max(0, $responseDeadline->diffInHours($now, false)) : 0; 
                        $remainingResponseTime = ($responseDeadline->gt($now)) ? max(0, $ticketData['responseTime'] - $remainingTimeToReply) : 0;
                        $remainingResolutionTime = ($responseDeadline->gt($now)) ? max(0, $ticketData['resolutionTime'] - $now->diffInDays($createdAt)) : 0;
                    @endphp
                        <tr>
                            <td>{{ $ticketData['ticket']->ticketid }}</td>
                            <td>{{ $ticketData['ticket']->status }}</td>
                            <td>{{ $remainingResponseTime }}</td>
                            <td>{{ $remainingResolutionTime }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endforeach
    </div>
</body>
</html>
