<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Event Reminder</title>
</head>
<body>
    <h1>Reminder for Your Upcoming Event: {{ $event->title }}</h1>
    
    <p><strong>Description:</strong> {{ $event->description }}</p>
    <p><strong>Start Time:</strong> {{ $event->start_time }}</p>
    <p><strong>End Time:</strong> {{ $event->end_time }}</p>
    <p><strong>Status:</strong> {{ ucfirst($event->status) }}</p>

    <p>We hope to see you there!</p>
    <p>Best Regards,<br>Your Event Management Team</p>
</body>
</html>
