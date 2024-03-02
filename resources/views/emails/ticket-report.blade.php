<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $emailData['emailSubject'] }}</title>
</head>
<body style="font-family: 'Arial', sans-serif;">

    <h1 style="color: #333;">{{ $emailData['emailSubject'] }}</h1>
    <p style="color: #555;">{{ $emailData['messageText'] }}</p>
    <p style="margin-top: 20px; color: #777;">Below are the statistics for {{ $emailData['client'] }} for the period from {{ $emailData['toDate'] }} to {{ $emailData['tillDate'] }}.</p>
    <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
        <thead style="background-color: #f2f2f2;">
            <tr>
                <th style="padding: 10px; text-align: left;">Status</th>
                <th style="padding: 10px; text-align: left;">Count</th>
            </tr>
        </thead>
        <tbody>
            @foreach($emailData['countsForClient'] as $count)
                <tr>
                    <td style="padding: 10px; border-bottom: 1px solid #ddd;">{{ $count->status }}</td>
                    <td style="padding: 10px; border-bottom: 1px solid #ddd;">{{ $count->count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

   

</body>
</html>
