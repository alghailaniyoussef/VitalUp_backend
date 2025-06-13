<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Challenge Completed!</title>
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
        .celebration {
            font-size: 3em;
            text-align: center;
            margin: 20px 0;
        }
        .title {
            color: #1f2937;
            font-size: 1.8em;
            margin-bottom: 20px;
            text-align: center;
        }
        .challenge-info {
            background: #f0fdf4;
            border-left: 4px solid #10b981;
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
        }
        .points-earned {
            background: #fef3c7;
            border: 2px solid #f59e0b;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
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

        <div class="celebration">🎉</div>

        <h1 class="title">Congratulations, {{ $user->name }}!</h1>

        <p>You have successfully completed the <strong>{{ $challenge->title }}</strong> challenge!</p>

        <div class="challenge-info">
            <h3>Challenge Details:</h3>
            <p><strong>Title:</strong> {{ $challenge->title }}</p>
            <p><strong>Category:</strong> {{ $challenge->category }}</p>
            <p><strong>Difficulty:</strong> {{ ucfirst($challenge->difficulty) }}</p>
            <p><strong>Duration:</strong> {{ $challenge->duration_days }} days</p>
        </div>

        <div class="points-earned">
            <h3>🏆 Points Earned: {{ $points_earned }}</h3>
            <p>Keep going to reach the next level!</p>
        </div>

        <p>Your dedication and consistency are admirable. Each completed challenge brings you closer to your wellness goals.</p>

        <div style="text-align: center;">
            <a href="{{ env('FRONTEND_URL') }}/challenges" class="cta-button">
                View More Challenges
            </a>
        </div>

        <div class="footer">
            <p>Thank you for being part of VitalUp</p>
            <p>If you don't want to receive these emails, you can <a href="{{ env('FRONTEND_URL') }}/settings">update your preferences</a></p>
        </div>
    </div>
</body>
</html>