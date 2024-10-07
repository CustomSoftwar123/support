<!-- resources/views/emails/ticket_reply.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criticle Ticket</title>
    
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
    <p>The following critical ticket is waiting for your reply</p>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Ticket Ids</th>
                    <th>Subject</th>
                    <th>Last Reply</th>
                    <th>Replied By</th>
                </tr>    
            </thead>
            <tbody>
                <tr>
                    <td>{{ $ticketNumber }}</td>
                    <td>{{ $subject }}</td>
                    <td>{{ $reply }}</td>
                    <td>{{ $repliedBy }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    </table>
   
</body>
</html>
