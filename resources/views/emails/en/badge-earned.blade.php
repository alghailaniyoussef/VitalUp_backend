<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Badge Earned!</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8f9fa;
        }
        .container {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo {
            font-size: 2.5em;
            font-weight: bold;
            color: #10b981;
            margin-bottom: 10px;
        }
        .badge-celebration {
            text-align: center;
            margin: 30px 0;
            padding: 20px;
            background: linear-gradient(135deg, #fbbf24, #f59e0b);
            border-radius: 15px;
            color: white;
        }
        .badge-icon {
            font-size: 4em;
            margin-bottom: 10px;
        }
        .title {
            color: #1f2937;
            font-size: 1.8em;
            margin-bottom: 20px;
            text-align: center;
        }
        .badge-info {
            background: #fef3c7;
            border-left: 4px solid #f59e0b;
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
        }
        .achievement-stats {
            background: #f0fdf4;
            border: 2px solid #10b981;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .cta-button {
            display: inline-block;
            background: #10b981;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            color: #6b7280;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">VitalUp</div>
        </div>

        <div class="badge-celebration">
            <div class="badge-icon">🏅</div>
            <h2>New Badge Unlocked!</h2>
        </div>

        <h1 class="title">Congratulations, {{ $user->name }}!</h1>

        <p>You've earned a new badge for your dedication and achievements!</p>

        <div class="badge-info">
            <h3>🏆 {{ $badge->name }}</h3>
            <p><strong>Description:</strong> {{ $badge->description }}</p>
            <p><strong>Criteria:</strong> {{ $badge->criteria }}</p>
            @if($badge->points_required)
                <p><strong>Points required:</strong> {{ $badge->points_required }}</p>
            @endif
        </div>

        <div class="achievement-stats">
            <h3>📊 Your Progress</h3>
            <p>With this new badge, you've demonstrated your commitment to wellness and health.</p>
            <p>Keep collecting badges to unlock new achievements!</p>
        </div>

        <p>Each badge represents an important step in your journey toward a healthier life. We're proud of your progress!</p>

        <div style="text-align: center;">
            <a href="{{ env('FRONTEND_URL') }}/badges" class="cta-button">
                View All My Badges
            </a>
        </div>

        <div class="footer">
            <p>Thank you for being part of VitalUp</p>
            <p>If you don't want to receive these emails, you can <a href="{{ env('FRONTEND_URL') }}/settings">update your preferences</a></p>
        </div>
    </div>
</body>
</html>