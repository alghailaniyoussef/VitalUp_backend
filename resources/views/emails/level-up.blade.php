<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¡Has Subido de Nivel!</title>
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
        .level-celebration {
            text-align: center;
            margin: 30px 0;
            padding: 20px;
            background: linear-gradient(135deg, #10b981, #059669);
            border-radius: 15px;
            color: white;
        }
        .level-icon {
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
        .stats {
            background: #f0fdf4;
            border-left: 4px solid #10b981;
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
        }
        .progress-bar {
            background-color: #e5e7eb;
            height: 20px;
            border-radius: 10px;
            margin: 20px 0;
            overflow: hidden;
        }
        .progress-fill {
            height: 100%;
            background-color: #10b981;
            border-radius: 10px;
            width: 0%;
            animation: fillProgress 1.5s ease-out forwards;
        }
        @keyframes fillProgress {
            from { width: 0%; }
            to { width: 100%; }
        }
        .cta-button {
            display: inline-block;
            background: #10b981;
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

        <div class="level-celebration">
            <div class="level-icon">🏆</div>
            <h1>¡NIVEL {{ $new_level }} DESBLOQUEADO!</h1>
            <p>Has alcanzado un nuevo nivel en tu viaje de bienestar</p>
        </div>

        <div class="content">
            <h2 class="title">¡Felicidades, {{ $user->name }}!</h2>

            <p>Tu dedicación y constancia han dado frutos. Has alcanzado el <strong>Nivel {{ $new_level }}</strong> en VitalUp, lo que demuestra tu compromiso con tu bienestar personal.</p>

            <div class="stats">
                <p><strong>Tu progreso actual:</strong></p>
                <p>✅ Nivel actual: {{ $new_level }}</p>
                <p>✅ Puntos acumulados: {{ $user->points }}</p>
                <p>✅ Próximo nivel: {{ $new_level + 1 }} (necesitas {{ $next_level_points }} puntos)</p>

                <div class="progress-bar">
                    <div class="progress-fill"></div>
                </div>
            </div>

            <p>Con cada nivel que subes, desbloqueas nuevas funcionalidades y retos más desafiantes que te ayudarán a seguir mejorando tu bienestar físico y mental.</p>

            <p>Continúa participando en retos, completando cuestionarios y manteniendo tus hábitos saludables para seguir avanzando.</p>

            <div style="text-align: center;">
                <a href="{{ env('APP_URL') }}/dashboard" class="cta-button">Ver mi perfil</a>
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
