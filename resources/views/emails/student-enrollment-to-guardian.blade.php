<!-- student-enrollment-guardian.html -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Your Ward's Enrollment at DotBitz</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background: #f0f9ff;
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
            background: linear-gradient(135deg, #0c4a6e 0%, #0369a1 100%);
            padding: 40px 20px;
            text-align: center;
            color: white;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 700;
        }
        .header p {
            margin: 10px 0 0;
            opacity: 0.9;
            font-size: 16px;
        }
        .family-icon {
            font-size: 48px;
            margin-bottom: 20px;
        }
        .content {
            padding: 40px;
        }
        .intro {
            text-align: center;
            margin-bottom: 30px;
        }
        .student-card {
            background: #f8fafc;
            border-radius: 10px;
            padding: 25px;
            margin: 25px 0;
            border: 2px solid #e2e8f0;
        }
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin: 20px 0;
        }
        .info-item {
            background: white;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
        }
        .info-label {
            font-size: 12px;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }
        .info-value {
            font-size: 16px;
            font-weight: 600;
            color: #0c4a6e;
        }
        .platform-info {
            background: #e6f7ff;
            padding: 20px;
            border-radius: 10px;
            margin: 25px 0;
        }
        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
            margin: 20px 0;
        }
        .feature {
            text-align: center;
            padding: 15px;
            background: white;
            border-radius: 8px;
        }
        .feature-icon {
            font-size: 24px;
            color: #0369a1;
            margin-bottom: 10px;
        }
        .safety-section {
            background: #fef3c7;
            padding: 20px;
            border-radius: 10px;
            margin: 25px 0;
            border-left: 4px solid #f59e0b;
        }
        .cta-button {
            display: inline-block;
            background: linear-gradient(135deg, #0c4a6e 0%, #0369a1 100%);
            color: white;
            padding: 15px 30px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 16px;
            margin: 20px 0;
            text-align: center;
        }
        .parent-portal {
            background: #f0f9ff;
            padding: 20px;
            border-radius: 10px;
            margin: 20px 0;
            text-align: center;
        }
        .highlight {
            color: #0c4a6e;
            font-weight: 600;
        }
        .footer {
            background: #f8fafc;
            text-align: center;
            font-size: 14px;
            color: #64748b;
            padding: 30px 20px;
            border-top: 1px solid #e2e8f0;
        }
        .contact-card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin: 20px auto;
            max-width: 400px;
        }
        .success-badge {
            display: inline-block;
            background: #10b981;
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="family-icon">👨‍👩‍👧‍👦</div>
            <h1>Welcome to the DotBitz Family!</h1>
            <p>Your ward has successfully enrolled in our platform</p>
        </div>

        <div class="content">
            <div class="intro">
                <h2 style="color: #0c4a6e;">Dear {{ $guardian->first_name }} {{ $guardian->last_name }},</h2>
                <p>Thank you for supporting <span class="highlight">{{ $student->first_name }} {{ $student->last_name }}</span>'s educational journey with DotBitz.</p>
                <span class="success-badge">Enrollment Confirmed</span>
            </div>

            <div class="student-card">
                <h3 style="color: #0c4a6e; margin-top: 0;">📚 Student Enrollment Details</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">Student Name</div>
                        <div class="info-value">{{ $student->first_name }} {{ $student->last_name }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Student ID</div>
                        <div class="info-value">#{{ $student->id }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Enrollment Date</div>
                        <div class="info-value">{{ date('F d, Y') }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Account Status</div>
                        <div class="info-value" style="color: #10b981;">Active & Verified</div>
                    </div>
                </div>

                <p style="margin-top: 20px;"><strong>Registered Email:</strong> {{ $student->email }}</p>
                <p><strong>Username:</strong> {{ $student->user_name }}</p>
            </div>

            <div class="platform-info">
                <h3 style="color: #0c4a6e; margin-top: 0;">🏫 About DotBitz</h3>
                <p>DotBitz is a premier online learning platform designed to teach programming and technology skills to students of all ages. Our mission is to make coding education accessible, engaging, and effective.</p>

                <div class="features">
                    <div class="feature">
                        <div class="feature-icon">🎯</div>
                        <strong>Structured Curriculum</strong>
                        <p style="font-size: 12px;">Progressive learning path</p>
                    </div>
                    <div class="feature">
                        <div class="feature-icon">👨‍🏫</div>
                        <strong>Expert Instructors</strong>
                        <p style="font-size: 12px;">Industry professionals</p>
                    </div>
                    <div class="feature">
                        <div class="feature-icon">📊</div>
                        <strong>Progress Tracking</strong>
                        <p style="font-size: 12px;">Regular updates & reports</p>
                    </div>
                    <div class="feature">
                        <div class="feature-icon">🏆</div>
                        <strong>Certification</strong>
                        <p style="font-size: 12px;">Industry-recognized</p>
                    </div>
                </div>
            </div>

            <div class="safety-section">
                <h4 style="color: #d97706; margin-top: 0;">🛡️ Safety & Security</h4>
                <p>At DotBitz, we prioritize student safety and online security:</p>
                <ul>
                    <li><strong>Secure Platform:</strong> All learning materials and communications are encrypted</li>
                    <li><strong>Content Moderation:</strong> All community interactions are monitored</li>
                    <li><strong>Privacy Protection:</strong> Student data is never shared with third parties</li>
                    <li><strong>Age-Appropriate Content:</strong> All courses are designed for specific age groups</li>
                </ul>
            </div>

            <div class="parent-portal">
                <h3 style="color: #0c4a6e; margin-top: 0;">👨‍👩‍👧‍👦 Parent/Guardian Portal</h3>
                <p>You can monitor {{ $student->first_name }}'s progress through our Parent Portal:</p>
                <a href="" class="cta-button">Access Parent Portal</a>
                <p style="font-size: 14px; color: #64748b; margin-top: 10px;">
                    Login credentials will be sent separately
                </p>
            </div>

            <div style="text-align: center; margin: 30px 0;">
                <h4 style="color: #0c4a6e;">Need to Contact Us?</h4>
                <div class="contact-card">
                    <p><strong>Parent Support Team:</strong></p>
                    <p>📧 parents@dotbitz.com<br>
                       📞 +1 (555) 123-4567 (Ext. 2)<br>
                       🕐 Mon-Fri, 9 AM - 5 PM EST</p>
                    <p style="font-size: 12px; color: #64748b;">
                        Dedicated support for parents and guardians
                    </p>
                </div>
            </div>

            <p style="text-align: center; font-size: 16px;">
                We look forward to supporting <span class="highlight">{{ $student->first_name }}</span>'s learning journey!<br>
                <strong>The DotBitz Team</strong>
            </p>
        </div>

        <div class="footer">
            <p><strong>DotBitz - Learning Platform</strong></p>
            <p>123 Tech Street, Silicon Valley, CA 94000</p>
            <p>This is an automated notification regarding your ward's enrollment.</p>
            <p style="font-size: 12px; margin-top: 15px;">
                <a href="#" style="color: #0c4a6e;">Unsubscribe</a> |
                <a href="#" style="color: #0c4a6e;">Privacy Policy</a> |
                <a href="#" style="color: #0c4a6e;">Parent Resources</a>
            </p>
            <p>&copy; {{ date('Y') }} DotBitz. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
