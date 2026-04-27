<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assessment Result - DotBitz</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background-color: #f1f5f9;
            color: #334155;
        }

        .email-wrapper {
            width: 100%;
            background-color: #f1f5f9;
            padding: 30px 16px;
        }

        .email-container {
            max-width: 580px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(0,0,0,0.08);
        }

        .header {
            background: linear-gradient(135deg, #073a89 0%, #0091b9 100%);
            padding: 40px 32px;
            text-align: center;
        }

        .header-logo {
            font-size: 13px;
            font-weight: 700;
            color: rgba(255,255,255,0.8);
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 16px;
        }

        .header h1 {
            color: #ffffff;
            font-size: 26px;
            font-weight: 700;
            margin: 0;
        }

        .header-sub {
            color: rgba(255,255,255,0.85);
            font-size: 14px;
            margin-top: 8px;
        }

        .content {
            padding: 40px 32px;
        }

        .greeting {
            font-size: 18px;
            color: #1e293b;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .intro {
            font-size: 15px;
            color: #64748b;
            margin-bottom: 28px;
            line-height: 1.6;
        }

        .assessment-title {
            background: #f8fafc;
            border-radius: 12px;
            padding: 16px 20px;
            margin-bottom: 24px;
            text-align: center;
            border: 1px solid #e2e8f0;
        }

        .assessment-label {
            font-size: 11px;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 1px;
            display: block;
            margin-bottom: 6px;
        }

        .assessment-name {
            font-size: 16px;
            font-weight: 600;
            color: #1e293b;
        }

        .score-card {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 24px;
            text-align: center;
            border: 1px solid #e2e8f0;
        }

        .score-label {
            font-size: 12px;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            display: block;
            margin-bottom: 12px;
        }

        .score-value {
            font-size: 48px;
            font-weight: 800;
            color: #073a89;
            display: block;
            margin-bottom: 8px;
        }

        .score-outof {
            font-size: 16px;
            color: #64748b;
        }

        .percentage {
            display: inline-block;
            background: #10b981;
            color: white;
            font-size: 14px;
            font-weight: 600;
            padding: 6px 16px;
            border-radius: 20px;
            margin-top: 12px;
        }

        .grade {
            display: inline-block;
            background: #f59e0b;
            color: white;
            font-size: 14px;
            font-weight: 600;
            padding: 6px 16px;
            border-radius: 20px;
            margin-top: 10px;
        }

        .remarks-box {
            background: #fefce8;
            border-left: 4px solid #eab308;
            padding: 16px 20px;
            border-radius: 12px;
            margin-bottom: 28px;
        }

        .remarks-label {
            font-size: 11px;
            color: #ca8a04;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
            display: block;
            margin-bottom: 8px;
        }

        .remarks-text {
            font-size: 14px;
            color: #854d0e;
            line-height: 1.5;
            margin: 0;
        }

        .register-btn {
            text-align: center;
            margin: 28px 0 20px;
        }

        .register-btn a {
            display: inline-block;
            background: linear-gradient(135deg, #073a89 0%, #0091b9 100%);
            color: #ffffff;
            font-size: 15px;
            font-weight: 600;
            padding: 14px 36px;
            border-radius: 40px;
            text-decoration: none;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 14px rgba(7, 58, 137, 0.3);
        }

        .login-box {
            background: #e6f0fa;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            margin: 20px 0;
            border: 1px solid #cbd5e1;
        }

        .login-text {
            font-size: 14px;
            color: #1e293b;
            margin-bottom: 8px;
        }

        .divider {
            height: 1px;
            background: linear-gradient(to right, #e2e8f0, transparent);
            margin: 24px 0;
        }

        .footer-note {
            font-size: 13px;
            color: #475569;
            text-align: center;
            line-height: 1.7;
            background: #f8fafc;
            padding: 16px;
            border-radius: 12px;
        }

        .footer {
            background: #1e293b;
            padding: 28px 32px;
            text-align: center;
        }

        .footer-brand {
            color: #ffffff;
            font-size: 15px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .footer-text {
            color: #94a3b8;
            font-size: 12px;
            line-height: 1.6;
        }

        @media (max-width: 480px) {
            .content {
                padding: 28px 20px;
            }
            .score-value {
                font-size: 36px;
            }
        }
    </style>
</head>
<body>
<div class="email-wrapper">
    <div class="email-container">

        <div class="header">
            <div class="header-logo">DotBitz</div>
            <h1>Assessment Result</h1>
            <p class="header-sub">{{ $courseName }}</p>
        </div>

        <div class="content">

            <p class="greeting">Dear <strong>{{ $recipientName }}</strong>,</p>
            <p class="intro">
                Your assessment for <strong>{{ $courseName }}</strong> has been reviewed by the instructor.
                Here are your results:
            </p>

            <div class="assessment-title">
                <span class="assessment-label">Assessment</span>
                <span class="assessment-name">{{ $assessmentTitle }}</span>
            </div>

            <div class="score-card">
                <span class="score-label">Your Score</span>
                <span class="score-value">{{ $obtainedMarks }}</span>
                <span class="score-outof">out of {{ $totalMarks }}</span>
            </div>

            @php
                $percentage = ($obtainedMarks / $totalMarks) * 100;
                $grade = '';
                if ($percentage >= 90) $grade = 'Excellent';
                elseif ($percentage >= 75) $grade = 'Very Good';
                elseif ($percentage >= 60) $grade = 'Good';
                elseif ($percentage >= 45) $grade = 'Satisfactory';
                else $grade = 'Need Improvement';
            @endphp

            <div style="text-align: center;">
                <div class="percentage">{{ number_format($percentage, 1) }}%</div>
                <div class="grade">{{ $grade }}</div>
            </div>

            @if($remarks)
            <div class="remarks-box">
                <span class="remarks-label">Remarks</span>
                <p class="remarks-text">{{ $remarks }}</p>
            </div>
            @endif

            {{-- ✅ CONDITION: Student ho to login message, Guest ho to buttons --}}
            @if($userType === 'student')
                <div class="login-box">
                    <p class="login-text"> To view your complete assessment results,</p>
                    <p class="login-text">please log in to your student portal.</p>
                </div>
            @else
                <div class="register-btn" style="margin-top: -10px;">
                    <a href="https://portal.dotbitz.com/guest/assessment-result?email={{ $email }}"
                       style="background: linear-gradient(135deg, #0091b9 0%, #007291 100%); text-decoration: none; display: inline-block; padding: 12px 25px; color: white; border-radius: 5px; font-weight: bold;">
                        Check Result →
                    </a>
                </div>
                <div class="register-btn" style="margin-top: 10px;">
                    <a href="https://portal.dotbitz.com/student/registration">
                        Register Yourself Now →
                    </a>
                </div>
            @endif

            <div class="divider"></div>

            @if($userType !== 'student')
            <p class="footer-note">
                Once registered, our team will contact you for further details and course enrollment.
            </p>
            @endif
        </div>

        <div class="footer">
            <p class="footer-brand">DotBitz Learning Platform</p>
            <p class="footer-text">
                Empowering careers through quality education<br>
                &copy; {{ date('Y') }} DotBitz. All rights reserved.
            </p>
            <p class="footer-text" style="margin-top: 10px;">
                <a href="mailto:info@dotbitz.com" style="color: #94a3b8; text-decoration: none;">info@dotbitz.com</a>
            </p>
        </div>
        
    </div>
</div>
</body>
</html>