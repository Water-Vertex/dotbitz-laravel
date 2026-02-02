<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Appointment Booked</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; background: #f4f4f4; }
        .container { max-width: 600px; margin: 30px auto; padding: 20px; background: #ffffff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        .header { text-align: center; padding-bottom: 20px; }
        .header h1 { margin: 0; color: #c53030; }
        .content { padding: 20px 0; }
        .footer { text-align: center; font-size: 12px; color: #777; padding-top: 20px; border-top: 1px solid #eee; }
        .details { background: #fff5f5; padding: 15px; border-radius: 5px; margin: 15px 0; }
        .highlight { color: #c53030; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>New Appointment Booked</h1>
            <p>A new appointment has been scheduled by a user.</p>
        </div>

        <div class="content">
            <p><strong>User Details:</strong></p>

            <div class="details">
                <p><strong>Name:</strong> {{ $appointment->name }}</p>
                <p><strong>Email:</strong> {{ $appointment->email }}</p>
                <p><strong>Phone:</strong> {{ $appointment->phone }}</p>@php
                     $course = \App\Models\Course::find($appointment->course_id);
                 @endphp
                <p><strong>Course:</strong> {{ $course ? $course->course_name : 'N/A' }}</p>
                <p><strong>Date:</strong> {{ $appointment->appointment_date }}</p>
                <p><strong>Time:</strong> {{ $appointment->appointment_time }}</p>
                @if($appointment->message)
                    <p><strong>Message:</strong> {{ $appointment->message }}</p>
                @endif
            </div>

            <p>Check your admin panel for more details.</p>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} {{env('APP_NAME')}}. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
