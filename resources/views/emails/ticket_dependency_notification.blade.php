<!DOCTYPE html>
<html>
<head>
    <title>Ticket Dependency Notification</title>
</head>
<body>
    <h1>Ticket Dependency Notification</h1>
    <p>Dear Team,</p>

    <p>The ticket with the following details is dependent on other tickets:</p>

    <p><b>Ticket ID:</b> {{ $ticket['id'] }}</p>
    <p><b>Subject:</b> {{ $ticket['subject'] }}</p>

    <h3>Dependencies:</h3>
    <ul>
        @foreach($dependencies as $dependency)
            <li><b>Ticket ID:</b> {{ $dependency['id'] }} | <b>Subject:</b> {{ $dependency['subject'] }}</li>
        @endforeach
    </ul>

    <p>Due to these dependencies, we might need to push the deadline further.</p>

    <p>Best regards,<br>Your Team</p>
</body>
</html>
