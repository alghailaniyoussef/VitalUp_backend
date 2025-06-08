<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¡Nueva Insignia Ganada!</title>
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
            <h2>¡Nueva Insignia Desbloqueada!</h2>
        </div>

        <h1 class="title">¡Felicidades, {{ $user->name }}!</h1>

        <p>¡Has ganado una nueva insignia por tu dedicación y logros!</p>

        <div class="badge-info">
            <h3>🏆 {{ $badge->name }}</h3>
            <p><strong>Descripción:</strong> {{ $badge->description }}</p>
            <p><strong>Criterio:</strong> {{ $badge->criteria }}</p>
            @if($badge->points_required)
                <p><strong>Puntos requeridos:</strong> {{ $badge->points_required }}</p>
            @endif
        </div>

        <div class="achievement-stats">
            <h3>📊 Tu Progreso</h3>
            <p>Con esta nueva insignia, has demostrado tu compromiso con el bienestar y la salud.</p>
            <p>¡Sigue coleccionando insignias para desbloquear nuevos logros!</p>
        </div>

        <p>Cada insignia representa un paso importante en tu viaje hacia una vida más saludable. ¡Estamos orgullosos de tu progreso!</p>

        <div style="text-align: center;">
            <a href="{{ env('FRONTEND_URL') }}/badges" class="cta-button">
                Ver Todas Mis Insignias
            </a>
        </div>

        <div class="footer">
            <p>Gracias por ser parte de VitalUp</p>
            <p>Si no deseas recibir estos emails, puedes <a href="{{ env('FRONTEND_URL') }}/settings">actualizar tus preferencias</a></p>
        </div>
    </div>
</body>
</html>
