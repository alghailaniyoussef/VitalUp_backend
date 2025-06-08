<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¡Te has unido a un nuevo reto!</title>
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
        .challenge-banner {
            text-align: center;
            margin: 30px 0;
            padding: 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 15px;
            color: white;
        }
        .challenge-icon {
            font-size: 4em;
            margin-bottom: 10px;
        }
        .title {
            color: #1f2937;
            font-size: 1.8em;
            margin-bottom: 20px;
            text-align: center;
        }
        .content {
            margin-bottom: 30px;
        }
        .challenge-info {
            background: #f5f3ff;
            border-left: 4px solid #8b5cf6;
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
        }
        .cta-button {
            display: inline-block;
            background: #8b5cf6;
            color: white;
            text-decoration: none;
            padding: 12px 25px;
            border-radius: 5px;
            font-weight: bold;
            margin-top: 20px;
            text-align: center;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 0.9em;
            color: #6b7280;
        }
        .social-links {
            margin-top: 15px;
        }
        .social-links a {
            display: inline-block;
            margin: 0 10px;
            color: #6b7280;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">VitalUp</div>
            <p>Tu compañero de bienestar</p>
        </div>

        <div class="challenge-banner">
            <div class="challenge-icon">🚀</div>
            <h1>¡NUEVO RETO INICIADO!</h1>
            <p>Te has unido al reto "{{ $challenge->title }}"</p>
        </div>

        <div class="content">
            <h2 class="title">¡Bienvenido al reto, {{ $user->name }}!</h2>

            <p>Has dado el primer paso hacia tu bienestar al unirte al reto <strong>{{ $challenge->title }}</strong>. Este reto está diseñado para ayudarte a desarrollar hábitos saludables y mejorar tu calidad de vida.</p>

            <div class="challenge-info">
                <p><strong>Detalles del reto:</strong></p>
                <p>📅 Duración: {{ $challenge->duration_days }} días</p>
                <p>🎯 Objetivo: {{ $challenge->description }}</p>
                <p>🏆 Puntos a ganar: {{ $challenge->points_reward }}</p>
            </div>

            <p>Durante este reto, recibirás consejos, recordatorios y motivación para ayudarte a mantener el rumbo. Recuerda que la consistencia es clave para el éxito.</p>

            <p>¡Estamos emocionados de acompañarte en este viaje hacia un estilo de vida más saludable!</p>

            <div style="text-align: center;">
                <a href="{{ env('APP_URL') }}/challenges/{{ $challenge->id }}" class="cta-button">Ver detalles del reto</a>
            </div>
        </div>

        <div class="footer">
            <p>Este correo fue enviado a {{ $user->email }} porque estás suscrito a las notificaciones de VitalUp.</p>
            <p>Puedes <a href="{{ env('APP_URL') }}/profile/preferences">gestionar tus preferencias de correo</a> en cualquier momento.</p>

            <div class="social-links">
                <a href="#">Twitter</a> |
                <a href="#">Facebook</a> |
                <a href="#">Instagram</a>
            </div>

            <p>&copy; {{ date('Y') }} VitalUp. Todos los derechos reservados.</p>
        </div>
    </div>
</body>
</html>
