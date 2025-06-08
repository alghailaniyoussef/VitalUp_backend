<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu Consejo de Bienestar</title>
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
        .tip-icon {
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
        .tip-content {
            background: #f0fdf4;
            border-left: 4px solid #10b981;
            padding: 25px;
            margin: 25px 0;
            border-radius: 5px;
            font-size: 1.1em;
        }
        .tip-category {
            background: #e0f2fe;
            color: #0277bd;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.9em;
            font-weight: bold;
            display: inline-block;
            margin-bottom: 15px;
        }
        .action-steps {
            background: #fef3c7;
            border: 2px solid #f59e0b;
            padding: 20px;
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
        .frequency-note {
            background: #f3f4f6;
            padding: 10px;
            border-radius: 5px;
            font-size: 0.9em;
            color: #6b7280;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">VitalUp</div>
        </div>

        <div class="tip-icon">💡</div>

        <h1 class="title">¡Hola, {{ $user->name }}!</h1>

        <p>Aquí tienes tu consejo de bienestar personalizado:</p>

        <div class="tip-category">{{ $tip_category ?? 'Bienestar General' }}</div>

        <div class="tip-content">
            <h3>{{ $tip_title ?? 'Consejo del Día' }}</h3>
            <p>{{ $tip_content ?? 'Recuerda mantenerte hidratado bebiendo al menos 8 vasos de agua al día. Una buena hidratación mejora tu energía, concentración y salud general.' }}</p>
        </div>

        @if(isset($action_steps))
        <div class="action-steps">
            <h4>🎯 Pasos para Implementar:</h4>
            <ul>
                @foreach($action_steps as $step)
                    <li>{{ $step }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <p>Pequeños cambios diarios pueden generar grandes resultados a largo plazo. ¡Tú puedes hacerlo!</p>

        <div style="text-align: center;">
            <a href="{{ env('FRONTEND_URL') }}/dashboard" class="cta-button">
                Ver Mi Progreso
            </a>
        </div>

        <div class="frequency-note">
            <p><strong>Frecuencia de emails:</strong> {{ ucfirst($user->email_frequency ?? 'diaria') }}</p>
            <p>Puedes cambiar la frecuencia en tu <a href="{{ env('FRONTEND_URL') }}/settings">configuración</a></p>
        </div>

        <div class="footer">
            <p>Gracias por ser parte de VitalUp</p>
            <p>Si no deseas recibir estos emails, puedes <a href="{{ env('FRONTEND_URL') }}/settings">actualizar tus preferencias</a></p>
        </div>
    </div>
</body>
</html>
