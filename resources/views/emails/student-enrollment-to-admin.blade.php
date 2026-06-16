<!-- student-enrollment-admin.html -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Student Enrollment - Admin Notification</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            color: #333;
            background: #f8fafc;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 30px auto;
            padding: 0;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
            padding: 30px 20px;
            text-align: center;
            color: white;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
        }
        .header p {
            margin: 10px 0 0;
            opacity: 0.9;
            font-size: 14px;
        }
        .alert-badge {
            display: inline-block;
            background: #ef4444;
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin: 10px 0;
        }
        .content {
            padding: 30px;
        }
        .student-info {
            background: #f1f5f9;
            border-radius: 10px;
            padding: 20px;
            margin: 20px 0;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
        }
        .info-table th {
            text-align: left;
            padding: 12px;
            background: #e2e8f0;
            color: #475569;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .info-table td {
            padding: 12px;
            border-bottom: 1px solid #e2e8f0;
        }
        .info-table tr:last-child td {
            border-bottom: none;
        }
        .highlight {
            color: #073a89;
            font-weight: 600;
        }
        .action-required {
            background: #fef3c7;
            border-left: 4px solid #f59e0b;
            padding: 20px;
            border-radius: 8px;
            margin: 25px 0;
        }
        .action-buttons {
            display: flex;
            gap: 10px;
            margin: 20px 0;
        }
        .btn {
            display: inline-block;
            padding: 12px 24px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
        }
        .btn-primary {
            background: #073a89;
            color: white;
        }
        .btn-secondary {
            background: #64748b;
            color: white;
        }
        .timestamp {
            font-size: 12px;
            color: #64748b;
            text-align: center;
            margin: 20px 0;
        }
        .footer {
            background: #1e293b;
            text-align: center;
            font-size: 12px;
            color: #cbd5e1;
            padding: 20px;
        }
        .statistics {
            background: #f8fafc;
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
            display: flex;
            justify-content: space-around;
        }
        .stat-item {
            text-align: center;
        }
        .stat-value {
            font-size: 24px;
            font-weight: 700;
            color: #073a89;
        }
        .stat-label {
            font-size: 12px;
            color: #64748b;
            text-transform: uppercase;
        }
        .guardian-info {
            background: #e6f7ff;
            border-radius: 8px;
            padding: 15px;
            margin: 15px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎓 New Student Enrollment</h1>
            <p>Administrator Notification</p>
            <div class="alert-badge">ACTION REQUIRED: Review Student Registration</div>
        </div>

        <div class="content">
            <h2 style="color: #1e293b; margin-top: 0;">New Student Registration Details</h2>
            <p>A new student has successfully enrolled in the platform.</p>

            <div class="student-info">
                <h3 style="color: #073a89; margin-top: 0;">📋 Student Information</h3>
                <table class="info-table">
                    <tr>
                        <th>Field</th>
                        <th>Details</th>
                    </tr>
                    <tr>
                        <td>Student U_ID</td>
                        <td><span class="highlight">#{{ $student->student_uid }}</span></td>
                    </tr>
                    <tr>
                        <td>Full Name</td>
                        <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                    </tr>
                    <tr>
                        <td>Username</td>
                        <td>{{ $student->user_name }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{{ $student->email }}</td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>{{ $student->phone }}</td>
                    </tr>
                    <tr>
                        <td>Date of Birth</td>
                        <td>{{ $student->date_of_birth }}</td>
                    </tr>

                    <tr>
                        <td>Gender</td>
                        <td>{{ ucfirst($student->gender) }}</td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>{{ $student->address }}, {{ $student->city }}, {{ $student->state }} {{ $student->zipcode }}</td>
                    </tr>
                    <tr>
                        <td>Registration Date</td>
                        <td>{{ date('F d, Y H:i:s') }}</td>
                    </tr>
                </table>
            </div>

            <div class="action-required">
                <h4 style="color: #d97706; margin-top: 0;">⚠️ Actions Required</h4>
                <ul>
                    <li>Verify student documents if required</li>
                    <li>Assign student to appropriate course batches</li>
                    <li>Set up student portal access if needed</li>
                    <li>Schedule welcome call or orientation</li>
                </ul>
            </div>

            <div class="action-buttons">
                <a href="" class="btn btn-primary">View Student Profile</a>
                <a href="" class="btn btn-secondary">Go to Dashboard</a>
            </div>

            <div class="timestamp">
                This notification was generated on {{ date('F d, Y \a\t h:i A') }}
            </div>
        </div>

        <div class="footer">
            <p><strong>DotBitz Admin System</strong></p>
            <p>This is an automated notification from the student enrollment system.</p>
            <p>&copy; {{ date('Y') }} DotBitz. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
