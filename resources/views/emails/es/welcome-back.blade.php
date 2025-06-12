<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>¡Bienvenido de Vuelta a VitalUp!</title>
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
            <h1>¡Bienvenido de Vuelta, {{ $user->name }}!</h1>
            <p>Te extrañamos en VitalUp</p>
        </div>
        <div class="content">
            <h2>¡Qué bueno verte de nuevo!</h2>
            <p>Han pasado <strong>{{ $days_since_last_login }} días</strong> desde tu última visita. ¡Estamos emocionados de tenerte de vuelta en tu viaje de bienestar!</p>
            
            <div class="stats">
                <h3>📊 Tu Progreso en VitalUp:</h3>
                <ul>
                    <li><strong>Nivel Actual:</strong> {{ $user->level }}</li>
                    <li><strong>Puntos Totales:</strong> {{ $user->points }}</li>
                    <li><strong>Días Desde Último Inicio de Sesión:</strong> {{ $days_since_last_login }}</li>
                    @if(isset($completed_challenges))
                    <li><strong>Desafíos Completados:</strong> {{ $completed_challenges }}</li>
                    @endif
                    @if(isset($badges_earned))
                    <li><strong>Insignias Ganadas:</strong> {{ $badges_earned }}</li>
                    @endif
                </ul>
            </div>
            
            <h3>🎯 Novedades Mientras Estuviste Ausente:</h3>
            <ul>
                @if(isset($new_challenges) && $new_challenges > 0)
                <li>{{ $new_challenges }} nuevos desafíos te están esperando</li>
                @endif
                @if(isset($new_tips) && $new_tips > 0)
                <li>{{ $new_tips }} nuevos consejos de salud han sido añadidos</li>
                @endif
                <li>Tus recomendaciones personalizadas han sido actualizadas</li>
                <li>Nuevos logros están disponibles para desbloquear</li>
            </ul>
            
            <p>¿Listo para continuar tu viaje de salud? ¡Continuemos donde lo dejamos!</p>
            
            <a href="{{ env('FRONTEND_URL', 'https://vital-up-frontend.vercel.app') }}/dashboard" class="button">Continúa Tu Viaje</a>
            
            <p>Recuerda, la consistencia es clave para lograr tus objetivos de salud. ¡Estamos aquí para apoyarte en cada paso del camino!</p>
            
            <p>¡Mantente fuerte y sigue creciendo!</p>
            <p><strong>El Equipo de VitalUp</strong></p>
        </div>
        <div class="footer">
            <p>© {{ date('Y') }} VitalUp. Todos los derechos reservados.</p>
            <p>Recibiste este correo porque volviste a iniciar sesión en VitalUp.</p>
        </div>
    </div>
</body>
</html>