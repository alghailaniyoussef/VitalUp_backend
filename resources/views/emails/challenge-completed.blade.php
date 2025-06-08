<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¡Reto Completado!</title>
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

        <h1 class="title">¡Felicidades, {{ $user->name }}!</h1>

        <p>¡Has completado exitosamente el reto <strong>{{ $challenge->title }}</strong>!</p>

        <div class="challenge-info">
            <h3>Detalles del Reto Completado:</h3>
            <p><strong>Título:</strong> {{ $challenge->title }}</p>
            <p><strong>Categoría:</strong> {{ $challenge->category }}</p>
            <p><strong>Dificultad:</strong> {{ ucfirst($challenge->difficulty) }}</p>
            <p><strong>Duración:</strong> {{ $challenge->duration_days }} días</p>
        </div>

        <div class="points-earned">
            <h3>🏆 Puntos Ganados: {{ $points_earned }}</h3>
            <p>¡Sigue así para alcanzar el siguiente nivel!</p>
        </div>

        <p>Tu dedicación y constancia son admirables. Cada reto completado te acerca más a tus objetivos de bienestar.</p>

        <div style="text-align: center;">
            <a href="{{ env('FRONTEND_URL') }}/challenges" class="cta-button">
                Ver Más Retos
            </a>
        </div>

        <div class="footer">
            <p>Gracias por ser parte de VitalUp</p>
            <p>Si no deseas recibir estos emails, puedes <a href="{{ env('FRONTEND_URL') }}/settings">actualizar tus preferencias</a></p>
        </div>
    </div>
</body>
</html>
