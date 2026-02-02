<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Appointment Confirmation</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; background: #f4f4f4; }
        .container { max-width: 600px; margin: 30px auto; padding: 20px; background: #ffffff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        .header { text-align: center; padding-bottom: 20px; }
        .header h1 { margin: 0; color: #2d3748; }
        .content { padding: 20px 0; }
        .footer { text-align: center; font-size: 12px; color: #777; padding-top: 20px; border-top: 1px solid #eee; }
        .highlight { color: #2b6cb0; font-weight: bold; }
        .details { background: #e6f7ff; padding: 15px; border-radius: 5px; margin: 15px 0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Appointment Booked Successfully</h1>
            <p>Thank you for booking your appointment with us!</p>
        </div>

        <div class="content">
            <p>Dear <span class="highlight">{{ $appointment->name }}</span>,</p>
            <p>Your appointment has been successfully scheduled. Here are the details:</p>

            <div class="details">
                 @php
                     $course = \App\Models\Course::find($appointment->course_id);
                 @endphp
                <p><strong>Course:</strong> {{ $course ? $course->course_name : 'N/A' }}</p>
                <p><strong>Date:</strong> {{ $appointment->appointment_date }}</p>
                <p><strong>Time:</strong> {{ $appointment->appointment_time }}</p>
                <p><strong>Email:</strong> {{ $appointment->email }}</p>
                <p><strong>Phone:</strong> {{ $appointment->phone }}</p>
                @if($appointment->message)
                    <p><strong>Message:</strong> {{ $appointment->message }}</p>
                @endif
            </div>

            <p>We look forward to seeing you!</p>
            <p>Best regards,<br>The {{env('APP_NAME')}} Team</p>
        </div>

        <div class="footer">
            <p>This is an automated confirmation email. Please do not reply.</p>
            <p>&copy; {{ date('Y') }} {{env('APP_NAME')}}. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
