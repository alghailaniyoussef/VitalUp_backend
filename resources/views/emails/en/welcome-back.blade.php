<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Welcome Back to VitalUp!</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 30px; text-align: center; border-radius: 10px 10px 0 0; }
        .content { background: #f9f9f9; padding: 30px; border-radius: 0 0 10px 10px; }
        .stats { background: white; padding: 20px; border-radius: 8px; margin: 20px 0; border-left: 4px solid #667eea; }
        .button { display: inline-block; background: #667eea; color: white; padding: 12px 30px; text-decoration: none; border-radius: 5px; margin: 20px 0; }
        .footer { text-align: center; margin-top: 30px; color: #666; font-size: 14px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Welcome Back, {{ $user->name }}!</h1>
            <p>We missed you at VitalUp</p>
        </div>
        <div class="content">
            <h2>Great to see you again!</h2>
            <p>It's been <strong>{{ $days_since_last_login }} days</strong> since your last visit. We're excited to have you back on your wellness journey!</p>
            
            <div class="stats">
                <h3>📊 Your VitalUp Progress:</h3>
                <ul>
                    <li><strong>Current Level:</strong> {{ $user->level }}</li>
                    <li><strong>Total Points:</strong> {{ $user->points }}</li>
                    <li><strong>Days Since Last Login:</strong> {{ $days_since_last_login }}</li>
                    @if(isset($completed_challenges))
                    <li><strong>Challenges Completed:</strong> {{ $completed_challenges }}</li>
                    @endif
                    @if(isset($badges_earned))
                    <li><strong>Badges Earned:</strong> {{ $badges_earned }}</li>
                    @endif
                </ul>
            </div>
            
            <h3>🎯 What's New While You Were Away:</h3>
            <ul>
                @if(isset($new_challenges) && $new_challenges > 0)
                <li>{{ $new_challenges }} new challenges are waiting for you</li>
                @endif
                @if(isset($new_tips) && $new_tips > 0)
                <li>{{ $new_tips }} new health tips have been added</li>
                @endif
                <li>Your personalized recommendations have been updated</li>
                <li>New achievements are available to unlock</li>
            </ul>
            
            <p>Ready to continue your health journey? Let's pick up where you left off!</p>
            
            <a href="{{ env('FRONTEND_URL', 'https://vital-up-frontend.vercel.app') }}/dashboard" class="button">Continue Your Journey</a>
            
            <p>Remember, consistency is key to achieving your health goals. We're here to support you every step of the way!</p>
            
            <p>Stay strong and keep growing!</p>
            <p><strong>The VitalUp Team</strong></p>
        </div>
        <div class="footer">
            <p>© {{ date('Y') }} VitalUp. All rights reserved.</p>
            <p>You received this email because you logged back into VitalUp.</p>
        </div>
    </div>
</body>
</html>