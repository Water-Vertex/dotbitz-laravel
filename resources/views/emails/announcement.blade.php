<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $announcementTitle }} - DotBitz</title>
    <style>
      
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; background-color: #f1f5f9; color: #334155; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
        .email-wrapper { width: 100%; background-color: #f1f5f9; padding: 30px 16px; }
        .email-container { max-width: 580px; margin: 0 auto; background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 24px rgba(0,0,0,0.08); }
        .header { background: linear-gradient(135deg, #073a89 0%, #0091b9 100%); padding: 36px 32px; text-align: center; }
        .header-logo { font-size: 13px; font-weight: 700; color: rgba(255,255,255,0.7); letter-spacing: 2px; text-transform: uppercase; margin-bottom: 16px; }
        .header h1 { color: #ffffff; font-size: 22px; font-weight: 700; line-height: 1.3; margin: 0; }
        .header-sub { color: rgba(255,255,255,0.75); font-size: 13px; margin-top: 8px; }
        .content { padding: 36px 32px; }
        .greeting { font-size: 16px; color: #1e293b; margin-bottom: 8px; font-weight: 500; }
        .intro { font-size: 14px; color: #64748b; margin-bottom: 24px; }
        .message-box { background: #f8fafc; border-left: 4px solid #073a89; border-radius: 0 10px 10px 0; padding: 20px 22px; margin-bottom: 28px; font-size: 15px; line-height: 1.8; color: #334155; }
        .info-row { background: #f8fafc; border-radius: 10px; padding: 16px 20px; margin-bottom: 28px; display: table; width: 100%; }
        .info-item { display: table-cell; text-align: center; padding: 4px 8px; vertical-align: middle; }
        .info-item + .info-item { border-left: 1px solid #e2e8f0; }
        .info-label { font-size: 11px; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px; display: block; margin-bottom: 4px; }
        .info-value { font-size: 13px; font-weight: 600; color: #1e293b; display: block; }
        .divider { height: 1px; background: #e2e8f0; margin: 24px 0; }
        .footer-note { font-size: 12px; color: #94a3b8; text-align: center; line-height: 1.6; }
        .footer { background: #1e293b; padding: 24px 32px; text-align: center; }
        .footer-brand { color: #ffffff; font-size: 14px; font-weight: 700; margin-bottom: 6px; }
        .footer-text { color: #94a3b8; font-size: 12px; line-height: 1.6; }
        @media only screen and (max-width: 600px) { /* Keep your responsive styles */ }
        @media only screen and (max-width: 400px) { /* Keep your responsive styles */ }
    </style>
</head>
<body>
<div class="email-wrapper">
    <div class="email-container">

        <!-- Header -->
        <div class="header">
            <div class="header-logo">DotBitz</div>
            <h1>📢 {{ $announcementTitle }}</h1>
            <p class="header-sub">Official Announcement</p>
        </div>

        <!-- Content -->
        <div class="content">
            <p class="greeting">Dear <strong>{{ $recipientName }}</strong>,</p>

            <!-- Intro text -->
            <p class="intro">
                @if(str_contains($announcedBy, 'Instructor'))
                    We have an important announcement from your <strong>{{ $announcedBy }}</strong>:
                @else
                    We have an important announcement from the <strong>DotBitz Team</strong>:
                @endif
            </p>

            <!-- Message -->
            <div class="message-box">
                {!! nl2br(e($announcementMessage)) !!}
            </div>

            <!-- Info row -->
            <div class="info-row">
                <div class="info-item">
                    <span class="info-label">From</span>
                    <span class="info-value">{{ $announcedBy ?? 'DotBitz Team' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Date</span>
                    <span class="info-value">{{ date('M d, Y') }}</span>
                </div>
            </div>

            <div class="divider"></div>

            <p class="footer-note">
                This announcement was sent to all registered members of DotBitz.<br>
                Please do not reply to this email.
            </p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p class="footer-brand">DotBitz Learning Platform</p>
            <p class="footer-text">
                This is an automated announcement email.<br>
                &copy; {{ date('Y') }} DotBitz. All rights reserved.
            </p>
        </div>

    </div>
</div>
</body>
</html>