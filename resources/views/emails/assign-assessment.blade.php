<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assessment Assigned - DotBitz</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; background-color: #f1f5f9; color: #334155; }
        .email-wrapper { width: 100%; background-color: #f1f5f9; padding: 30px 16px; }
        .email-container { max-width: 580px; margin: 0 auto; background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 24px rgba(0,0,0,0.08); }
        .header { background: linear-gradient(135deg, #073a89 0%, #0091b9 100%); padding: 36px 32px; text-align: center; }
        .header-logo { font-size: 13px; font-weight: 700; color: rgba(255,255,255,0.7); letter-spacing: 2px; text-transform: uppercase; margin-bottom: 16px; }
        .header h1 { color: #ffffff; font-size: 22px; font-weight: 700; line-height: 1.3; margin: 0; }
        .header-sub { color: rgba(255,255,255,0.75); font-size: 13px; margin-top: 8px; }
        .content { padding: 36px 32px; }
        .greeting { font-size: 16px; color: #1e293b; margin-bottom: 8px; font-weight: 500; }
        .intro { font-size: 14px; color: #64748b; margin-bottom: 24px; line-height: 1.5; }
        .info-row { background: #f8fafc; border-radius: 10px; padding: 16px 20px; margin-bottom: 28px; display: table; width: 100%; }
        .info-item { display: table-cell; text-align: center; padding: 4px 8px; vertical-align: middle; }
        .info-item + .info-item { border-left: 1px solid #e2e8f0; }
        .info-label { font-size: 11px; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px; display: block; margin-bottom: 4px; }
        .info-value { font-size: 13px; font-weight: 600; color: #1e293b; display: block; }
        .register-btn { text-align: center; margin: 24px 0; }
        .register-btn a { display: inline-block; background: linear-gradient(135deg, #073a89 0%, #0091b9 100%); color: #ffffff; font-size: 14px; font-weight: 600; padding: 14px 32px; border-radius: 8px; text-decoration: none; letter-spacing: 0.5px; box-shadow: 0 4px 12px rgba(7, 58, 137, 0.2); }
        .register-note { font-size: 12px; color: #64748b; text-align: center; margin-top: 10px; font-weight: 500; }
        .divider { height: 1px; background: #e2e8f0; margin: 24px 0; }
        .footer-note { font-size: 13px; color: #475569; text-align: center; line-height: 1.7; background: #f1f5f9; padding: 15px; border-radius: 8px; }
        .footer { background: #1e293b; padding: 24px 32px; text-align: center; }
        .footer-brand { color: #ffffff; font-size: 14px; font-weight: 700; margin-bottom: 6px; }
        .footer-text { color: #94a3b8; font-size: 12px; line-height: 1.6; }
    </style>
</head>
<body>
<div class="email-wrapper">
    <div class="email-container">

        {{-- Header --}}
        <div class="header">
            <div class="header-logo">DotBitz</div>
            @if($isAdmin)
                <h1>📋 New Assessment Assigned</h1>
                <p class="header-sub">Student Assessment Notification</p>
            @else
                <h1>📋 Assessment Assigned</h1>
                <p class="header-sub">Take the first step towards your certification</p>
            @endif
        </div>

        {{-- Content --}}
        <div class="content">

            @if($isAdmin)
                <p class="greeting">Dear <strong>Admin</strong>,</p>
                <p class="intro">A new assessment has been assigned to the following student:</p>
            @else
                <p class="greeting">Dear <strong>{{ $recipientName }}</strong>,</p>
                <p class="intro">
                    A new assessment has been assigned to you. Please complete it within the given time to enroll in the <strong>{{ $courseName }}</strong>.
                </p>
            @endif

           {{-- Info Box --}}
            <div class="info-row">
                @if($isAdmin)
                    <div class="info-item">
                        <span class="info-label">Student</span>
                        <span class="info-value">{{ $recipientName }}</span>
                    </div>
                @endif
                <div class="info-item">
                    <span class="info-label">Assessment</span>
                    <span class="info-value">{{ $assessmentTitle }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Time Allowed</span>
                    <span class="info-value">{{ $timeToComplete }} mins</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Total Marks</span>
                    <span class="info-value">{{ $totalMarks }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Due Date</span>
                    <span class="info-value">
                        {{ $dueDate ? \Carbon\Carbon::parse($dueDate)->format('d M Y') : 'N/A' }}
                    </span>
                </div>
            </div>

            {{-- Expiry Note --}}
            <p style="font-size: 11px; color: #e11d48; text-align: center; margin-top: -15px; margin-bottom: 20px;">
                Note: Once this due date passes, the assessment will expire and you will have to re-book it.
            </p>


            {{-- BUTTON LOGIC: Sirf Non-Registered (isGuest) bacho ke liye --}}
            @if(!$isAdmin && $isGuest)
                <div class="register-btn">
                    <a href="https://portal.dotbitz.com/student/registration">
                        Register Yourself Now →
                    </a>
                </div>

            <div class="register-btn" style="margin-top: -10px;">
    <a href="https://portal.dotbitz.com/guest/guest-assessments?email={{ $email }}"
       style="background: linear-gradient(135deg, #0091b9 0%, #007291 100%); text-decoration: none; display: inline-block; padding: 12px 25px; color: white; border-radius: 5px; font-weight: bold;">
       Start test now →
    </a>
    <p class="register-note">
        Complete your account to track your progress online.
    </p>
</div>
            @endif

            <div class="divider"></div>

            {{-- Instruction Section --}}
            @if($isAdmin)
                <p class="footer-note">
                    Please check your admin panel for more details.<br>
                    This is an automated notification.
                </p>
            @elseif($isGuest)
                <div class="footer-note">
                    <strong>Note:</strong><br>
                    You can attempt the assessment directly. However, we recommend registering your account to save your results permanently.
                </div>
            @else
                <p class="footer-note">
                    Please login to your portal to attempt the assessment online.<br>
                    Good luck! 🎯
                </p>
            @endif

        </div>

        {{-- Footer --}}
        <div class="footer">
            <p class="footer-brand">DotBitz Learning Platform</p>
            <p class="footer-text">
                This is an automated email. Please do not reply directly to this address.<br>
                &copy; {{ date('Y') }} DotBitz. All rights reserved.
            </p>
        </div>

    </div>
</div>
</body>
</html>
