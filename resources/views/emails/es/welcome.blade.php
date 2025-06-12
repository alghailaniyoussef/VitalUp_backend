<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>¡Bienvenido a VitalUp!</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 30px; text-align: center; border-radius: 10px 10px 0 0; }
        .content { background: #f9f9f9; padding: 30px; border-radius: 0 0 10px 10px; }
        .button { display: inline-block; background: #667eea; color: white; padding: 12px 30px; text-decoration: none; border-radius: 5px; margin: 20px 0; }
        .footer { text-align: center; margin-top: 30px; color: #666; font-size: 14px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>¡Bienvenido a VitalUp!</h1>
            <p>Tu viaje hacia una mejor salud comienza ahora</p>
        </div>
        <div class="content">
            <h2>¡Hola {{ $user->name }}!</h2>
            <p>¡Estamos emocionados de tenerte en la comunidad VitalUp! Has dado el primer paso hacia un estilo de vida más saludable y vibrante.</p>
            
            <h3>Lo que puedes hacer con VitalUp:</h3>
            <ul>
                <li>📊 Seguir tu progreso de salud con cuestionarios interactivos</li>
                <li>🏆 Unirte a desafíos y competir con otros</li>
                <li>🎯 Ganar puntos y desbloquear logros</li>
                <li>💡 Recibir consejos diarios de salud personalizados</li>
                <li>📈 Monitorear tu viaje de bienestar</li>
            </ul>
            
            <p>¿Listo para comenzar? ¡Inicia sesión en tu cuenta y comienza a explorar!</p>
            
            <a href="{{ env('FRONTEND_URL', 'https://vital-up-frontend.vercel.app') }}/auth/signin" class="button">Comienza Tu Viaje</a>
            
            <p>Si tienes alguna pregunta, no dudes en contactar a nuestro equipo de soporte.</p>
            
            <p>¡Mantente saludable y sigue creciendo!</p>
            <p><strong>El Equipo de VitalUp</strong></p>
        </div>
        <div class="footer">
            <p>© {{ date('Y') }} VitalUp. Todos los derechos reservados.</p>
            <p>Recibiste este correo porque te registraste en VitalUp.</p>
        </div>
    </div>
</body>
</html>