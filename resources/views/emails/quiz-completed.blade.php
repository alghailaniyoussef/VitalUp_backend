<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quiz Completado - {{ $quiz->title }}</title>
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
            background-color: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #4CAF50;
            margin-bottom: 10px;
        }
        .title {
            font-size: 28px;
            color: #2c3e50;
            margin-bottom: 10px;
        }
        .subtitle {
            font-size: 16px;
            color: #7f8c8d;
        }
        .quiz-info {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
            border-left: 4px solid #4CAF50;
        }
        .quiz-title {
            font-size: 20px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 15px;
        }
        .stats {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 15px;
        }
        .stat-item {
            text-align: center;
            flex: 1;
            min-width: 120px;
        }
        .stat-number {
            font-size: 24px;
            font-weight: bold;
            color: #4CAF50;
        }
        .stat-label {
            font-size: 12px;
            color: #7f8c8d;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .performance {
            text-align: center;
            margin: 25px 0;
        }
        .percentage {
            font-size: 48px;
            font-weight: bold;
            color: #4CAF50;
            margin-bottom: 5px;
        }
        .performance-text {
            font-size: 16px;
            color: #7f8c8d;
        }
        .message {
            background-color: #e8f5e8;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
            text-align: center;
        }
        .congratulations {
            font-size: 18px;
            color: #2c3e50;
            margin-bottom: 10px;
        }
        .points-earned {
            font-size: 20px;
            font-weight: bold;
            color: #4CAF50;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            color: #7f8c8d;
            font-size: 14px;
        }
        @media (max-width: 600px) {
            .stats {
                flex-direction: column;
            }
            .percentage {
                font-size: 36px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">🏆 VitalUp</div>
            <h1 class="title">¡Quiz Completado!</h1>
            <p class="subtitle">Felicitaciones por completar el quiz</p>
        </div>

        <div class="quiz-info">
            <div class="quiz-title">{{ $quiz->title }}</div>

            <div class="stats">
                <div class="stat-item">
                    <div class="stat-number">{{ $score }}</div>
                    <div class="stat-label">Respuestas Correctas</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">{{ $total_questions }}</div>
                    <div class="stat-label">Total Preguntas</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">{{ $points_earned }}</div>
                    <div class="stat-label">Puntos Ganados</div>
                </div>
            </div>
        </div>

        <div class="performance">
            <div class="percentage">{{ $percentage }}%</div>
            <div class="performance-text">Porcentaje de Acierto</div>
        </div>

        <div class="message">
            <div class="congratulations">
                ¡Excelente trabajo, {{ $user->name }}!
            </div>
            <div class="points-earned">
                Has ganado {{ $points_earned }} puntos
            </div>
        </div>

        @if($quiz->description)
        <div style="margin: 20px 0; padding: 15px; background-color: #f8f9fa; border-radius: 8px;">
            <strong>Sobre este quiz:</strong><br>
            {{ $quiz->description }}
        </div>
        @endif

        <div class="footer">
            <p>Sigue practicando y mejorando tus conocimientos.</p>
            <p>¡Nos vemos en el próximo quiz!</p>
            <p style="margin-top: 15px; font-size: 12px;">
                Este email fue enviado porque completaste un quiz en VitalUp.
            </p>
        </div>
    </div>
</body>
</html>
