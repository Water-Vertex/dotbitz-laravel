<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Pre-Registration</title>
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
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        .info-table tr:nth-child(even) {
            background: #f8f9fa;
        }
        .info-table td {
            padding: 12px 15px;
            font-size: 14px;
            border-bottom: 1px solid #eee;
            color: #555;
        }
        .info-table td:first-child {
            font-weight: bold;
            color: #063989;
            width: 35%;
        }
        .badge {
            background: #FF6500;
            color: white;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
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
        @media only screen and (max-width: 480px) {
            .email-body { padding: 15px; }
            .info-table td { padding: 10px; font-size: 13px; }
        }
    </style>
</head>
<body>
    <div class="email-wrapper">

        <!-- Header -->
        <div class="email-header">
            <h1>🔔 New Pre-Registration!</h1>
            <p>DotBitz Admin Notification</p>
        </div>

        <!-- Body -->
        <div class="email-body">

            <p style="color:#555; font-size:14px; margin-bottom:5px;">
                A new user has pre-registered. Details are below:
            </p>

            <table class="info-table">
                <tr>
                    <td>👤 Name</td>
                    <td>{{ $preRegistration->name }}</td>
                </tr>
                <tr>
                    <td>✉️ Email</td>
                    <td>{{ $preRegistration->email }}</td>
                </tr>
                <tr>
                    <td>📞 Phone</td>
                    <td>{{ $preRegistration->phone }}</td>
                </tr>
                <tr>
                    <td>💬 Message</td>
                    <td>{{ $preRegistration->message ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <td>📅 Registered At</td>
                    <td>{{ $preRegistration->created_at->format('M d, Y — h:i A') }}</td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td><span class="badge">New Registration</span></td>
                </tr>
            </table>

        </div>

        <!-- Footer -->
        <div class="email-footer">
            <p>© {{ date('Y') }} DotBitz. All rights reserved.</p>
            <p><a href="https://dotbitz.com">dotbitz.com</a></p>
        </div>

    </div>
</body>
</html>