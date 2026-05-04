<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pre-Registration Confirmed</title>
    <style>
    * { box-sizing: border-box; }
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 10px;
    }
    .email-wrapper {
        max-width: 600px;
        width: 100%;
        margin: 20px auto;
        background: #ffffff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    .email-header {
        background: linear-gradient(135deg, #063989, #0a5cd8);
        padding: 25px 20px;
        text-align: center;
    }
    .email-header h1 {
        color: #FECE09;
        font-size: 22px;
        margin: 0 0 5px 0;
    }
    .email-header p {
        color: #ffffff;
        margin: 0;
        font-size: 13px;
    }
    .email-body {
        padding: 25px 20px;
    }
    .greeting {
        font-size: 17px;
        color: #063989;
        font-weight: bold;
        margin-bottom: 12px;
    }
    .message {
        color: #555;
        font-size: 14px;
        line-height: 1.7;
        margin-bottom: 20px;
    }
    .event-box {
        background: linear-gradient(135deg, #FFF8E7, #fff);
        border: 2px solid #FECE09;
        border-radius: 12px;
        padding: 20px;
        margin: 20px 0;
    }
    .event-box h3 {
        color: #063989;
        font-size: 16px;
        margin: 0 0 15px 0;
        padding-bottom: 10px;
        border-bottom: 2px solid #FECE09;
    }
    .event-detail {
        display: table;
        width: 100%;
        margin-bottom: 15px;
    }
    .event-detail .icon {
        display: table-cell;
        width: 40px;
        vertical-align: top;
        padding-top: 2px;
        font-size: 20px;
    }
    .event-detail .info {
        display: table-cell;
        vertical-align: top;
        padding-left: 10px;
    }
    .event-detail .info h4 {
        margin: 0 0 3px 0;
        color: #063989;
        font-size: 13px;
        font-weight: bold;
    }
    .event-detail .info p {
        margin: 0;
        color: #555;
        font-size: 13px;
        line-height: 1.5;
    }
    .calendar-btn {
        display: block;
        width: 100%;
        max-width: 280px;
        margin: 20px auto;
        background: #FF6500;
        color: #ffffff !important;
        text-decoration: none !important;
        padding: 14px 20px;
        border-radius: 8px;
        font-size: 15px;
        font-weight: bold;
        text-align: center;
    }
    .note-box {
        background: #f0f4ff;
        border-left: 4px solid #063989;
        border-radius: 6px;
        padding: 15px;
        margin: 20px 0;
        color: #555;
        font-size: 13px;
        line-height: 1.6;
    }
    .email-footer {
        background: #063989;
        padding: 18px 15px;
        text-align: center;
        color: #ffffff;
        font-size: 12px;
    }
    .email-footer p { margin: 4px 0; }
    .email-footer a {
        color: #FECE09;
        text-decoration: none;
    }

    /* ✅ Mobile responsive */
    @media only screen and (max-width: 480px) {
        body { padding: 5px; }
        .email-wrapper { margin: 10px auto; border-radius: 8px; }
        .email-header { padding: 20px 15px; }
        .email-header h1 { font-size: 18px; }
        .email-body { padding: 20px 15px; }
        .event-box { padding: 15px; }
        .calendar-btn {
            max-width: 100%;
            font-size: 14px;
            padding: 12px 15px;
        }
        .greeting { font-size: 15px; }
        .message { font-size: 13px; }
    }
</style>
<body>
    <div class="email-wrapper">

        <!-- Header -->
        <div class="email-header">
            <h1>🎉 You're Pre-Registered!</h1>
            <p>DotBitz — Empowering Future Innovators</p>
        </div>

        <!-- Body -->
        <div class="email-body">

            <p class="greeting">Hello {{ $preRegistration->name }},</p>

            <p class="message">
                Congratulations! Your pre-registration has been successfully confirmed. 
                We're thrilled to have you join us for our upcoming session. 
                Please find the meeting details below and add the event to your calendar so you don't miss it!
            </p>

            <!-- Event Details Box -->
            <div class="event-box">
                <h3>📅 Meeting Details</h3>

                <div class="event-detail">
                    <div class="icon">📍</div>
                    <div class="info">
                        <h4>Location</h4>
                        <p>Meeting Room 2A<br>
                        Columbus Metropolitan Library<br>
                        4500 Hickory Chase Way, Hilliard OH</p>
                    </div>
                </div>

                <div class="event-detail">
                    <div class="icon">🕔</div>
                    <div class="info">
                        <h4>Time</h4>
                        <p>5:00 PM — 6:00 PM</p>
                    </div>
                </div>

                <div class="event-detail">
                    <div class="icon">✉️</div>
                    <div class="info">
                        <h4>Registered Email</h4>
                        <p>{{ $preRegistration->email }}</p>
                    </div>
                </div>
            </div>

            <!-- Add to Calendar Button -->
           @php
    $title    = urlencode('DotBitz Pre-Registration Meeting');
    $location = urlencode('Meeting Room 2A, Columbus Metropolitan Library, 4500 Hickory Chase Way, Hilliard OH');
    $details  = urlencode('Pre-registration session for DotBitz upcoming batch. Registered by: ' . $preRegistration->name);
    
    // ✅ Date nahi — user khud select karega
    $googleUrl = "https://calendar.google.com/calendar/render?action=TEMPLATE&text={$title}&details={$details}&location={$location}";
@endphp

            <a href="{{ $googleUrl }}" class="calendar-btn" target="_blank">
                📅 Add to Google Calendar
            </a>

            <!-- Note -->
            <div class="note-box">
                <strong>📌 Please Note:</strong> Make sure to arrive a few minutes early. 
                Bring this confirmation email with you. If you have any questions, 
                feel free to contact us at 
                <a href="mailto:info@dotbitz.com" style="color: #063989;">info@dotbitz.com</a>
            </div>

            <p class="message">
                We look forward to seeing you there! 🚀<br><br>
                Warm regards,<br>
                <strong>The DotBitz Team</strong>
            </p>

        </div>

        <!-- Footer -->
        <div class="email-footer">
            <p>© {{ date('Y') }} DotBitz. All rights reserved.</p>
            <p>
                <a href="https://dotbitz.com">dotbitz.com</a> | 
                <a href="mailto:info@dotbitz.com">info@dotbitz.com</a>
            </p>
        </div>

    </div>
</body>
</html>