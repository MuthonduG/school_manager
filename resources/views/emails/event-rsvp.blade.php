<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Event RSVP Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .email-container {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 30px;
            max-width: 600px;
            margin: auto;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        h2 {
            color: #333333;
        }
        p {
            color: #555555;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h2>RSVP Confirmed: {{ $event->event_name }}</h2>
        <p>Hi {{ $user->name }},</p>
        <p>You've successfully RSVP'd to <strong>{{ $event->event_name }}</strong>, organized by <strong>{{ $event->organizer }}</strong>.</p>
        <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($event->event_date)->format('F j, Y') }}</p>

        @if(!empty($event->description))
            <p><strong>About the event:</strong></p>
            <p>{{ $event->description }}</p>
        @endif

        <p>We look forward to seeing you there!</p>
        <p>— The {{ $event->club->club_name }} Team</p>
    </div>
</body>
</html>
