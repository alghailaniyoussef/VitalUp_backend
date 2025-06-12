<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Welcome to VitalUp!</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 30px; text-align: center; border-radius: 10px 10px 0 0; }
        .content { background: #f9f9f9; padding: 30px; border-radius: 0 0 10px 10px; }
        .button { display: inline-block; background: #667eea; color: white; padding: 12px 30px; text-decoration: none; border-radius: 5px; margin: 20px 0; }
        .footer { text-align: center; margin-top: 30px; color: #666; font-size: 14px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Welcome to VitalUp!</h1>
            <p>Your journey to better health starts now</p>
        </div>
        <div class="content">
            <h2>Hello {{ $user->name }}!</h2>
            <p>We're excited to have you join the VitalUp community! You've taken the first step towards a healthier, more vibrant lifestyle.</p>
            
            <h3>What you can do with VitalUp:</h3>
            <ul>
                <li>📊 Track your health progress with interactive quizzes</li>
                <li>🏆 Join challenges and compete with others</li>
                <li>🎯 Earn points and unlock achievements</li>
                <li>💡 Receive personalized daily health tips</li>
                <li>📈 Monitor your wellness journey</li>
            </ul>
            
            <p>Ready to get started? Log in to your account and begin exploring!</p>
            
            <a href="{{ env('FRONTEND_URL', 'https://vital-up-frontend.vercel.app') }}/auth/signin" class="button">Start Your Journey</a>
            
            <p>If you have any questions, feel free to reach out to our support team.</p>
            
            <p>Stay healthy and keep growing!</p>
            <p><strong>The VitalUp Team</strong></p>
        </div>
        <div class="footer">
            <p>© {{ date('Y') }} VitalUp. All rights reserved.</p>
            <p>You received this email because you signed up for VitalUp.</p>
        </div>
    </div>
</body>
</html>