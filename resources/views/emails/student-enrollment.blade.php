<!-- student-enrollment-student.html -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Welcome to DotBitz! Enrollment Confirmation</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 30px auto;
            padding: 0;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #073a89 0%, #0091b9 100%);
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
        .logo {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            font-weight: bold;
            color: #ffd500;
        }
        .content {
            padding: 40px;
        }
        .welcome-section {
            text-align: center;
            margin-bottom: 30px;
        }
        .welcome-icon {
            font-size: 48px;
            color: #0091b9;
            margin-bottom: 20px;
        }
        .course-card {
            background: #f8fafc;
            border-radius: 10px;
            padding: 25px;
            margin: 25px 0;
            border-left: 4px solid #073a89;
        }
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin: 25px 0;
        }
        .info-item {
            background: #f1f5f9;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
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
            color: #073a89;
        }
        .cta-button {
            display: inline-block;
            background: linear-gradient(135deg, #073a89 0%, #0091b9 100%);
            color: white;
            padding: 15px 30px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 16px;
            margin: 20px 0;
            text-align: center;
        }
        .next-steps {
            background: #e6f7ff;
            padding: 20px;
            border-radius: 10px;
            margin: 25px 0;
        }
        .next-steps h3 {
            color: #073a89;
            margin-top: 0;
        }
        .step {
            display: flex;
            align-items: center;
            margin: 15px 0;
        }
        .step-number {
            background: #073a89;
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            flex-shrink: 0;
        }
        .highlight {
            color: #073a89;
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
        .social-links {
            margin: 20px 0;
        }
        .social-links a {
            display: inline-block;
            margin: 0 10px;
            color: #073a89;
            text-decoration: none;
        }
        .contact-info {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .badge {
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
            <div class="logo">DB</div>
            <h1>Welcome to DotBitz!</h1>
            <p>Your programming journey begins now</p>
        </div>

        <div class="content">
            <div class="welcome-section">
                <div class="welcome-icon">🚀</div>
                <h2>Congratulations, {{ $student->first_name }}!</h2>
                <p>You have successfully enrolled in our platform. We're excited to have you join our community of learners.</p>
                <span class="badge">Enrollment Complete</span>
            </div>

            <div class="course-card">
                <h3 style="color: #073a89; margin-top: 0;">Enrollment Details</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">Student U_ID</div>
                        <div class="info-value">#{{ $student->student_uid }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Enrollment Date</div>
                        <div class="info-value">{{ date('F d, Y') }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Account Status</div>
                        <div class="info-value" style="color: #10b981;">Active</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Username</div>
                        <div class="info-value">{{ $student->user_name }}</div>
                    </div>
                </div>
            </div>

            <div class="next-steps">
                <h3>📋 Next Steps to Get Started</h3>

                <div class="step">
                    <div class="step-number">1</div>
                    <div>
                        <strong>Complete Your Profile</strong>
                        <p>Add a profile picture and complete your bio to get personalized course recommendations.</p>
                    </div>
                </div>

                <div class="step">
                    <div class="step-number">2</div>
                    <div>
                        <strong>Explore Your Dashboard</strong>
                        <p>Check out your learning dashboard with progress tracking and course recommendations.</p>
                    </div>
                </div>

                <div class="step">
                    <div class="step-number">3</div>
                    <div>
                        <strong>Start Your First Course</strong>
                        <p>Begin with our "Introduction to Programming" course or explore our full catalog.</p>
                    </div>
                </div>

                <div class="step">
                    <div class="step-number">4</div>
                    <div>
                        <strong>Join the Community</strong>
                        <p>Connect with fellow learners in our Discord community and discussion forums.</p>
                    </div>
                </div>
            </div>

            <div style="text-align: center; margin: 30px 0;">
                <a href="" class="cta-button">Access Your Learning Dashboard</a>
                <p style="font-size: 14px; color: #64748b; margin-top: 10px;">
                    Use your registered email and password to log in
                </p>
            </div>

            <div class="contact-info">
                <h4 style="color: #073a89; margin-top: 0;">Need Help?</h4>
                <p>Our support team is here to help you get started:</p>
                <p>📧 Email: support@dotbitz.com<br>
                   📞 Phone: +1 (555) 123-4567<br>
                   🕐 Support Hours: Mon-Fri, 9 AM - 6 PM EST</p>
            </div>
        </div>

        <div class="footer">
            <div class="social-links">
                <a href="#">Website</a> •
                <a href="#">Blog</a> •
                <a href="#">Twitter</a> •
                <a href="#">LinkedIn</a> •
                <a href="#">YouTube</a>
            </div>
            <p><strong>DotBitz - Learn to Code, Build Your Future</strong></p>
            <p>This is an automated enrollment confirmation. Please do not reply to this email.</p>
            <p>&copy; {{ date('Y') }} DotBitz. All rights reserved.<br>
               123 Tech Street, Silicon Valley, CA 94000</p>
            <p style="font-size: 12px; margin-top: 15px;">
                You're receiving this email because you registered on DotBitz.<br>
                <a href="#" style="color: #073a89;">Unsubscribe</a> |
                <a href="#" style="color: #073a89;">Privacy Policy</a> |
                <a href="#" style="color: #073a89;">Terms of Service</a>
            </p>
        </div>
    </div>
</body>
</html>
