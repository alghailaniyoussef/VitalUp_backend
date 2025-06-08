<?php

namespace Database\Seeders;

use App\Models\Tip;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipSeederEs extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Spanish VitalUp Professional Wellness Tips
        $tips = [
            // General Wellness Tips
            [
                'title' => 'Comienza tu día con intención',
                'content' => 'Inicia cada mañana estableciendo una intención positiva para el día. Tómate 2-3 minutos para visualizar cómo quieres sentirte y qué quieres lograr. Esta práctica simple puede mejorar significativamente tu claridad mental y bienestar general.',
                'category' => 'general',
                'locale' => 'es',
                'action_steps' => [
                    'Dedica 2-3 minutos cada mañana a la reflexión',
                    'Visualiza cómo quieres sentirte durante el día',
                    'Establece una intención clara y positiva'
                ],
                'is_active' => true,
            ],
            [
                'title' => 'El poder de la respiración profunda',
                'content' => 'Practica la técnica de respiración 4-7-8: Inhala por 4 tiempos, mantén por 7, exhala por 8. Esto activa tu sistema nervioso parasimpático, reduciendo el estrés y promoviendo la relajación. Perfecto para momentos de ansiedad o antes de dormir.',
                'category' => 'general',
                'locale' => 'es',
                'action_steps' => [
                    'Inhala contando hasta 4',
                    'Mantén la respiración por 7 tiempos',
                    'Exhala lentamente por 8 tiempos',
                    'Repite 4-6 ciclos cuando te sientas estresado'
                ],
                'is_active' => true,
            ],
            [
                'title' => 'Hidratación para la vitalidad',
                'content' => 'Comienza tu día con un vaso de agua y apunta a 8-10 vasos durante el día. Añade limón o pepino para sabor y nutrientes extra. La hidratación adecuada aumenta la energía, mejora la salud de la piel y apoya la función cognitiva.',
                'category' => 'general',
                'locale' => 'es',
                'action_steps' => [
                    'Bebe un vaso de agua al despertar',
                    'Mantén una botella de agua visible durante el día',
                    'Añade limón o pepino para variedad',
                    'Apunta a 8-10 vasos diarios'
                ],
                'is_active' => true,
            ],

            // Nutrition Tips
            [
                'title' => 'Alimentación consciente',
                'content' => 'Come sin distracciones durante al menos una comida al día. Mastica lentamente, saborea cada bocado y presta atención a las señales de hambre y saciedad de tu cuerpo. Esta práctica mejora la digestión y la satisfacción con las comidas.',
                'category' => 'nutrition',
                'locale' => 'es',
                'action_steps' => [
                    'Elige una comida al día para comer sin distracciones',
                    'Guarda el teléfono y apaga la TV',
                    'Mastica cada bocado 20-30 veces',
                    'Pausa entre bocados para evaluar tu saciedad'
                ],
                'is_active' => true,
            ],
            [
                'title' => 'Método del plato equilibrado',
                'content' => 'Llena la mitad de tu plato con vegetales, un cuarto con proteína magra y un cuarto con granos integrales. Este método visual simple asegura comidas balanceadas sin contar calorías complicadas.',
                'category' => 'nutrition',
                'locale' => 'es',
                'action_steps' => [
                    'Usa un plato de tamaño normal (23-25 cm)',
                    'Llena la mitad con vegetales coloridos',
                    'Añade proteína magra en un cuarto del plato',
                    'Completa con granos integrales o carbohidratos complejos'
                ],
                'is_active' => true,
            ],

            // Fitness Tips
            [
                'title' => 'Movimiento de escritorio',
                'content' => 'Incorpora estiramientos de cuello, rotaciones de hombros y elevaciones de pantorrillas cada hora mientras trabajas. Estos micro-movimientos previenen la rigidez y mejoran la circulación durante largos períodos sentado.',
                'category' => 'fitness',
                'locale' => 'es',
                'action_steps' => [
                    'Configura un recordatorio cada hora',
                    'Haz 5 rotaciones de cuello en cada dirección',
                    'Realiza 10 rotaciones de hombros hacia atrás',
                    'Eleva las pantorrillas 15 veces bajo el escritorio'
                ],
                'is_active' => true,
            ],
            [
                'title' => 'Rutina matutina de 7 minutos',
                'content' => 'Comienza tu día con una rutina rápida de peso corporal: jumping jacks, flexiones, sentadillas y plancha. Solo 7 minutos activan tu metabolismo y establecen un tono energético para el día.',
                'category' => 'fitness',
                'locale' => 'es',
                'action_steps' => [
                    '1 minuto de jumping jacks para calentar',
                    '2 minutos de flexiones (modifica según tu nivel)',
                    '2 minutos de sentadillas',
                    '2 minutos de plancha (mantén o haz repeticiones)'
                ],
                'is_active' => true,
            ],

            // Mental Health Tips
            [
                'title' => 'Técnica de conexión a tierra 5-4-3-2-1',
                'content' => 'Cuando te sientas abrumado, identifica: 5 cosas que puedes ver, 4 que puedes tocar, 3 que puedes oír, 2 que puedes oler, 1 que puedes saborear. Esta técnica te ancla en el momento presente y reduce la ansiedad.',
                'category' => 'mental_health',
                'locale' => 'es',
                'action_steps' => [
                    'Identifica 5 cosas que puedes ver a tu alrededor',
                    'Toca 4 objetos diferentes y nota sus texturas',
                    'Escucha 3 sonidos distintos en tu entorno',
                    'Identifica 2 olores que puedas percibir',
                    'Nota 1 sabor en tu boca'
                ],
                'is_active' => true,
            ],
            [
                'title' => 'Diario de una línea',
                'content' => 'Escribe una oración cada día sobre algo positivo que experimentaste. Esta práctica simple pero poderosa entrena tu cerebro para notar y recordar momentos positivos, mejorando el estado de ánimo general.',
                'category' => 'mental_health',
                'locale' => 'es',
                'action_steps' => [
                    'Elige un momento fijo del día para escribir',
                    'Mantén un cuaderno pequeño o usa una app',
                    'Escribe solo una oración sobre algo positivo',
                    'Sé específico en lugar de general'
                ],
                'is_active' => true,
            ],

            // Sleep Tips
            [
                'title' => 'Ritual de relajación',
                'content' => 'Crea una rutina relajante de 30 minutos antes de acostarte: luz tenue, música suave, lectura ligera o estiramientos suaves. La consistencia señala a tu cuerpo que es hora de relajarse y prepararse para el sueño.',
                'category' => 'sleep',
                'locale' => 'es',
                'action_steps' => [
                    'Comienza tu rutina 30 minutos antes de dormir',
                    'Baja las luces en toda la casa',
                    'Elige una actividad relajante (lectura, música suave)',
                    'Evita pantallas y conversaciones estimulantes'
                ],
                'is_active' => true,
            ],
            [
                'title' => 'Exposición a la luz matutina',
                'content' => 'Obtén 10-15 minutos de luz solar natural dentro de la primera hora de despertar. Esto regula tu ritmo circadiano, mejora el estado de ánimo y hace que sea más fácil conciliar el sueño por la noche.',
                'category' => 'sleep',
                'locale' => 'es',
                'action_steps' => [
                    'Sal al exterior dentro de la primera hora de despertar',
                    'Si no puedes salir, siéntate cerca de una ventana',
                    'Evita usar gafas de sol durante esta exposición',
                    'Combínalo con una caminata matutina si es posible'
                ],
                'is_active' => true,
            ],

            // Social Wellness Tips
            [
                'title' => 'Conexiones de calidad',
                'content' => 'Prioriza las conversaciones cara a cara sobre las interacciones digitales cuando sea posible. Incluso 10 minutos de conexión genuina pueden fortalecer significativamente las relaciones y mejorar el bienestar mental.',
                'category' => 'social',
                'locale' => 'es',
                'action_steps' => [
                    'Programa al menos una conversación cara a cara por semana',
                    'Guarda el teléfono durante las conversaciones',
                    'Haz preguntas abiertas para profundizar la conexión',
                    'Practica la escucha activa sin juzgar'
                ],
                'is_active' => true,
            ],
            [
                'title' => 'Actos de bondad aleatorios',
                'content' => 'Realiza un pequeño acto de bondad diariamente: sostén una puerta, envía un mensaje alentador o ayuda a un colega. Estos gestos crean ondas positivas y mejoran tu propio sentido de propósito y conexión.',
                'category' => 'social',
                'locale' => 'es',
                'action_steps' => [
                    'Identifica una oportunidad de bondad cada día',
                    'Comienza con gestos simples como sonreír o saludar',
                    'Envía un mensaje de agradecimiento a alguien',
                    'Ofrece ayuda sin esperar nada a cambio'
                ],
                'is_active' => true,
            ],
        ];

        foreach ($tips as $tip) {
            Tip::create($tip);
        }
    }
}
