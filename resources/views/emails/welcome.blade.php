<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a VitalUp</title>
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
        .welcome-title {
            color: #1f2937;
            font-size: 1.8em;
            margin-bottom: 20px;
        }
        .content {
            margin-bottom: 30px;
        }
        .stats {
            background: #f0fdf4;
            border-left: 4px solid #10b981;
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
        }
        .cta-button {
            display: inline-block;
            background: #10b981;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 25px;
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
            <div class="logo">🌱 VitalUp</div>
            <h1 class="welcome-title">¡Bienvenido, {{ $user->name }}!</h1>
        </div>

        <div class="content">
            <p>¡Nos emociona tenerte como parte de la comunidad VitalUp! 🎉</p>

            <p>VitalUp es tu compañero perfecto para adoptar hábitos saludables y sostenibles. Aquí podrás:</p>

            <ul>
                <li>🏆 Completar desafíos diarios de salud y bienestar</li>
                <li>🧠 Participar en quizzes educativos</li>
                <li>🏅 Ganar insignias y puntos por tus logros</li>
                <li>🌍 Contribuir a un mundo más saludable y sostenible</li>
            </ul>

            <div class="stats">
                <strong>Tu perfil actual:</strong><br>
                📊 Nivel: {{ $user->level }}<br>
                ⭐ Puntos: {{ $user->points }}<br>
                🎯 Intereses: {{ implode(', ', $user->interests ?? []) }}
            </div>

            <p>¿Listo para comenzar tu viaje hacia una vida más saludable?</p>

            <div style="text-align: center;">
                <a href="{{ config('app.frontend_url', 'http://localhost:3000') }}" class="cta-button">
                    🚀 Comenzar Ahora
                </a>
            </div>
        </div>

        <div class="footer">
            <p>Gracias por unirte a VitalUp 💚</p>
            <p>Si tienes alguna pregunta, no dudes en contactarnos.</p>
            <p><small>Este correo fue enviado desde VitalUp - Tu plataforma de bienestar integral</small></p>
        </div>
    </div>
</body>
</html>
