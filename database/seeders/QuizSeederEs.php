<?php

namespace Database\Seeders;

use App\Models\Quiz;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class QuizSeederEs extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // VitalUp Professional Wellness Quizzes - Spanish
        $quizzes = [
            [
                'title' => 'Fundamentos de Nutrición',
                'description' => 'Pon a prueba tus conocimientos sobre principios esenciales de nutrición y hábitos alimentarios saludables para un bienestar óptimo.',
                'questions' => json_encode([
                    [
                        'id' => 1,
                        'text' => '¿Cuál macronutriente es la fuente principal de energía del cuerpo?',
                        'options' => ['Proteínas', 'Carbohidratos', 'Grasas', 'Vitaminas'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 2,
                        'text' => '¿Cuántas porciones de frutas y verduras deben consumir los adultos diariamente?',
                        'options' => ['3-4 porciones', '5-9 porciones', '1-2 porciones', '10+ porciones'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 3,
                        'text' => '¿Cuál es la ingesta diaria recomendada de agua para adultos?',
                        'options' => ['4-6 vasos', '8-10 vasos', '2-3 vasos', '12+ vasos'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 4,
                        'text' => '¿Qué nutriente es esencial para la reparación y crecimiento muscular?',
                        'options' => ['Carbohidratos', 'Vitaminas', 'Proteína', 'Minerales'],
                        'correct_answer' => 2
                    ],
                    [
                        'id' => 5,
                        'text' => '¿Qué porcentaje de tu plato debe llenarse con verduras?',
                        'options' => ['25%', '50%', '75%', '10%'],
                        'correct_answer' => 1
                    ]
                ]),
                'points_per_question' => 10,
                'is_active' => true,
                'available_from' => Carbon::now(),
                'available_until' => Carbon::now()->addMonths(12),
                'locale' => 'es',
                'icon_path' => 'trophy'
            ],
            [
                'title' => 'Conciencia de Salud Mental',
                'description' => 'Explora conceptos clave en salud mental y manejo del estrés para un mejor bienestar psicológico.',
                'questions' => json_encode([
                    [
                        'id' => 1,
                        'text' => '¿Qué práctica es más efectiva para reducir el estrés diario?',
                        'options' => ['Ejercicios de respiración profunda', 'Ver televisión', 'Comer comida reconfortante', 'Trabajar más horas'],
                        'correct_answer' => 0
                    ],
                    [
                        'id' => 2,
                        'text' => '¿Cuántas horas de sueño necesitan la mayoría de adultos por noche?',
                        'options' => ['5-6 horas', '7-9 horas', '10-12 horas', '4-5 horas'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 3,
                        'text' => '¿Cuál es una forma saludable de lidiar con la ansiedad?',
                        'options' => ['Evitar todas las situaciones estresantes', 'Meditación mindfulness', 'Aislarse', 'Ignorar los sentimientos'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 4,
                        'text' => '¿Qué actividad puede mejorar la claridad mental?',
                        'options' => ['Ejercicio regular', 'Cafeína excesiva', 'Saltarse comidas', 'Quedarse en interiores'],
                        'correct_answer' => 0
                    ],
                    [
                        'id' => 5,
                        'text' => '¿Cuál es el beneficio de mantener un diario de gratitud?',
                        'options' => ['Mejora la memoria', 'Mejora el pensamiento positivo', 'Aumenta el apetito', 'Reduce el sueño'],
                        'correct_answer' => 1
                    ]
                ]),
                'points_per_question' => 10,
                'is_active' => true,
                'available_from' => Carbon::now(),
                'available_until' => Carbon::now()->addMonths(12),
                'locale' => 'es',
                'icon_path' => 'brain'
            ],
            [
                'title' => 'Fundamentos de Fitness',
                'description' => 'Pon a prueba tu comprensión de los principios del ejercicio y la aptitud física para un estilo de vida más saludable.',
                'questions' => json_encode([
                    [
                        'id' => 1,
                        'text' => '¿Cuántos minutos de ejercicio moderado deben hacer los adultos por semana?',
                        'options' => ['75 minutos', '150 minutos', '300 minutos', '30 minutos'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 2,
                        'text' => '¿Qué tipo de ejercicio es mejor para la salud cardiovascular?',
                        'options' => ['Solo levantamiento de pesas', 'Ejercicio aeróbico', 'Solo estiramientos', 'Solo yoga'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 3,
                        'text' => '¿Cuándo es el mejor momento para estirar?',
                        'options' => ['Solo antes del ejercicio', 'Después del calentamiento', 'Nunca', 'Solo cuando hay lesión'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 4,
                        'text' => '¿Cuál es el tiempo de descanso recomendado entre sesiones de entrenamiento de fuerza?',
                        'options' => ['No se necesita descanso', '24-48 horas', '1 semana', '10 minutos'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 5,
                        'text' => '¿Cuál es una señal de sobreentrenamiento?',
                        'options' => ['Aumento de energía', 'Mejor sueño', 'Fatiga persistente', 'Mejor estado de ánimo'],
                        'correct_answer' => 2
                    ]
                ]),
                'points_per_question' => 10,
                'is_active' => true,
                'available_from' => Carbon::now(),
                'available_until' => Carbon::now()->addMonths(12),
                'locale' => 'es',
                'icon_path' => 'muscle'
            ],
            [
                'title' => 'Optimización del Sueño',
                'description' => 'Aprende sobre hábitos de sueño saludables y su impacto en el bienestar general y el rendimiento diario.',
                'questions' => json_encode([
                    [
                        'id' => 1,
                        'text' => '¿Cuál es la temperatura ideal del dormitorio para dormir?',
                        'options' => ['75-80°F', '60-67°F', '50-55°F', '80-85°F'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 2,
                        'text' => '¿Cuánto tiempo antes de acostarse debes evitar las pantallas?',
                        'options' => ['30 minutos', '1 hora', '3 horas', '5 minutos'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 3,
                        'text' => '¿Qué bebida debe evitarse antes de acostarse?',
                        'options' => ['Té de hierbas', 'Agua', 'Café', 'Leche tibia'],
                        'correct_answer' => 2
                    ],
                    [
                        'id' => 4,
                        'text' => '¿Qué es la higiene del sueño?',
                        'options' => ['Ducharse antes de acostarse', 'Prácticas que promueven un buen sueño', 'Limpiar tu dormitorio', 'Lavar las sábanas'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 5,
                        'text' => '¿Qué actividad puede mejorar la calidad del sueño?',
                        'options' => ['Ejercicio nocturno', 'Horario regular de sueño', 'Comidas grandes antes de acostarse', 'Luces brillantes'],
                        'correct_answer' => 1
                    ]
                ]),
                'points_per_question' => 10,
                'is_active' => true,
                'available_from' => Carbon::now(),
                'available_until' => Carbon::now()->addMonths(12),
                'locale' => 'es',
                'icon_path' => 'star'
            ],
            [
                'title' => 'Manejo del Estrés',
                'description' => 'Descubre estrategias efectivas para manejar el estrés y mantener el equilibrio emocional en la vida diaria.',
                'questions' => json_encode([
                    [
                        'id' => 1,
                        'text' => '¿Cuál es un síntoma físico del estrés crónico?',
                        'options' => ['Mejor digestión', 'Mejor sueño', 'Tensión muscular', 'Aumento de energía'],
                        'correct_answer' => 2
                    ],
                    [
                        'id' => 2,
                        'text' => '¿Qué es la técnica de respiración 4-7-8?',
                        'options' => ['Inhalar 4, mantener 7, exhalar 8', 'Ejercitarse por 4-7-8 minutos', 'Comer 4-7-8 veces al día', 'Dormir 4-7-8 horas'],
                        'correct_answer' => 0
                    ],
                    [
                        'id' => 3,
                        'text' => '¿Qué actividad NO se recomienda para el alivio del estrés?',
                        'options' => ['Meditación', 'Ejercicio', 'Consumo excesivo de alcohol', 'Respiración profunda'],
                        'correct_answer' => 2
                    ],
                    [
                        'id' => 4,
                        'text' => '¿Qué es la relajación muscular progresiva?',
                        'options' => ['Correr progresivamente más rápido', 'Tensar y relajar grupos musculares', 'Levantar pesas más pesadas', 'Estirarse por horas'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 5,
                        'text' => '¿Cómo puede la gestión del tiempo ayudar a reducir el estrés?',
                        'options' => ['Trabajando más horas', 'Priorizando tareas', 'Evitando todas las responsabilidades', 'Multitarea constante'],
                        'correct_answer' => 1
                    ]
                ]),
                'points_per_question' => 10,
                'is_active' => true,
                'available_from' => Carbon::now(),
                'available_until' => Carbon::now()->addMonths(12),
                'locale' => 'es',
                'icon_path' => 'shield'
            ],
            [
                'title' => 'Hidratación y Salud',
                'description' => 'Comprende la importancia de la hidratación adecuada y sus efectos en las funciones corporales y el bienestar.',
                'questions' => json_encode([
                    [
                        'id' => 1,
                        'text' => '¿Qué porcentaje del cuerpo humano es agua?',
                        'options' => ['45%', '60%', '75%', '90%'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 2,
                        'text' => '¿Cuál es una señal de deshidratación?',
                        'options' => ['Orina clara', 'Aumento de energía', 'Orina amarilla oscura', 'Mejor concentración'],
                        'correct_answer' => 2
                    ],
                    [
                        'id' => 3,
                        'text' => '¿Cuándo debes beber más agua?',
                        'options' => ['Solo cuando tengas sed', 'Durante el ejercicio', 'Nunca', 'Solo con las comidas'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 4,
                        'text' => '¿Qué bebida contribuye más a la hidratación?',
                        'options' => ['Café', 'Refresco', 'Agua', 'Bebidas energéticas'],
                        'correct_answer' => 2
                    ],
                    [
                        'id' => 5,
                        'text' => '¿Cómo afecta la hidratación adecuada a la salud de la piel?',
                        'options' => ['La hace grasa', 'Mejora la elasticidad', 'Causa brotes', 'No tiene efecto'],
                        'correct_answer' => 1
                    ]
                ]),
                'points_per_question' => 10,
                'is_active' => true,
                'available_from' => Carbon::now(),
                'available_until' => Carbon::now()->addMonths(12),
                'locale' => 'es',
                'icon_path' => 'heart'
            ],
            [
                'title' => 'Bienestar Ambiental',
                'description' => 'Explora cómo tu entorno afecta tu salud y aprende prácticas de vida sostenible.',
                'questions' => json_encode([
                    [
                        'id' => 1,
                        'text' => '¿Qué práctica reduce el impacto ambiental y mejora la salud?',
                        'options' => ['Conducir a todas partes', 'Caminar o andar en bicicleta', 'Usar artículos desechables', 'Comer alimentos procesados'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 2,
                        'text' => '¿Cuál es el beneficio de las plantas de interior?',
                        'options' => ['Aumentan la humedad', 'Mejoran la calidad del aire', 'Reducen el ruido', 'Todas las anteriores'],
                        'correct_answer' => 3
                    ],
                    [
                        'id' => 3,
                        'text' => '¿Cuál es una elección alimentaria sostenible?',
                        'options' => ['Alimentos altamente procesados', 'Productos locales de temporada', 'Frutas exóticas importadas', 'Comida rápida'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 4,
                        'text' => '¿Cómo beneficia pasar tiempo en la naturaleza a la salud?',
                        'options' => ['Reduce el estrés', 'Mejora el estado de ánimo', 'Fortalece el sistema inmune', 'Todas las anteriores'],
                        'correct_answer' => 3
                    ],
                    [
                        'id' => 5,
                        'text' => '¿Cuál es la mejor manera de reducir los residuos plásticos?',
                        'options' => ['Usar más artículos desechables', 'Elegir alternativas reutilizables', 'Ignorar el problema', 'Comprar más productos plásticos'],
                        'correct_answer' => 1
                    ]
                ]),
                'points_per_question' => 10,
                'is_active' => true,
                'available_from' => Carbon::now(),
                'available_until' => Carbon::now()->addMonths(12),
                'locale' => 'es',
                'icon_path' => 'crown'
            ],
            [
                'title' => 'Mindfulness y Meditación',
                'description' => 'Aprende sobre prácticas de mindfulness y técnicas de meditación para la claridad mental y la paz.',
                'questions' => json_encode([
                    [
                        'id' => 1,
                        'text' => '¿Qué es mindfulness?',
                        'options' => ['Pensar en el futuro', 'Estar presente en el momento', 'Multitarea', 'Evitar pensamientos'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 2,
                        'text' => '¿Cuánto tiempo deben meditar los principiantes?',
                        'options' => ['2 horas', '5-10 minutos', '30 segundos', '1 hora'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 3,
                        'text' => '¿Cuál es un beneficio de la meditación regular?',
                        'options' => ['Aumento de ansiedad', 'Mejor enfoque', 'Más estrés', 'Menos sueño'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 4,
                        'text' => '¿Qué debes hacer cuando tu mente divaga durante la meditación?',
                        'options' => ['Frustrarte', 'Dejar de meditar', 'Regresar suavemente el enfoque a la respiración', 'Pensar más fuerte'],
                        'correct_answer' => 2
                    ],
                    [
                        'id' => 5,
                        'text' => '¿Qué ambiente es mejor para la meditación?',
                        'options' => ['Ruidoso y brillante', 'Silencioso y cómodo', 'Mientras conduces', 'Durante reuniones'],
                        'correct_answer' => 1
                    ]
                ]),
                'points_per_question' => 10,
                'is_active' => true,
                'available_from' => Carbon::now(),
                'available_until' => Carbon::now()->addMonths(12),
                'locale' => 'es',
                'icon_path' => 'lightning'
            ],
            [
                'title' => 'Equilibrio Trabajo-Vida',
                'description' => 'Descubre estrategias para mantener límites saludables entre el trabajo y la vida personal.',
                'questions' => json_encode([
                    [
                        'id' => 1,
                        'text' => '¿Cuál es una señal de mal equilibrio trabajo-vida?',
                        'options' => ['Ejercicio regular', 'Agotamiento crónico', 'Buenas relaciones', 'Sueño adecuado'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 2,
                        'text' => '¿Qué práctica ayuda a mantener el equilibrio trabajo-vida?',
                        'options' => ['Trabajar fines de semana', 'Establecer límites', 'Saltarse descansos', 'Revisar emails constantemente'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 3,
                        'text' => '¿Cómo puedes desconectarte del trabajo en casa?',
                        'options' => ['Mantener emails del trabajo abiertos', 'Crear un espacio de trabajo dedicado', 'Trabajar en la cama', 'Nunca tomar descansos'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 4,
                        'text' => '¿Cuál es el beneficio de tomar descansos regulares?',
                        'options' => ['Disminución de productividad', 'Mejor enfoque', 'Más estrés', 'Menos creatividad'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 5,
                        'text' => '¿Qué actividad apoya el equilibrio trabajo-vida?',
                        'options' => ['Trabajar durante el almuerzo', 'Practicar pasatiempos', 'Quedarse tarde todos los días', 'Saltarse vacaciones'],
                        'correct_answer' => 1
                    ]
                ]),
                'points_per_question' => 10,
                'is_active' => true,
                'available_from' => Carbon::now(),
                'available_until' => Carbon::now()->addMonths(12),
                'locale' => 'es',
                'icon_path' => 'target'
            ],
            [
                'title' => 'Formación de Hábitos Saludables',
                'description' => 'Aprende la ciencia detrás de la formación de hábitos y estrategias para construir comportamientos saludables duraderos.',
                'questions' => json_encode([
                    [
                        'id' => 1,
                        'text' => '¿Cuánto tiempo toma típicamente formar un nuevo hábito?',
                        'options' => ['7 días', '21-66 días', '1 año', '3 días'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 2,
                        'text' => '¿Cuál es la forma más efectiva de construir un nuevo hábito?',
                        'options' => ['Empezar con grandes cambios', 'Comenzar con acciones pequeñas y consistentes', 'Hacerlo perfectamente siempre', 'Esperar motivación'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 3,
                        'text' => '¿Qué estrategia ayuda a mantener nuevos hábitos?',
                        'options' => ['Apilamiento de hábitos', 'Hacerlo aleatoriamente', 'Evitar recordatorios', 'Hacerlo complicado'],
                        'correct_answer' => 0
                    ],
                    [
                        'id' => 4,
                        'text' => '¿Qué debes hacer cuando te saltas un día de tu nuevo hábito?',
                        'options' => ['Rendirte completamente', 'Retomar al día siguiente', 'Esperar hasta el próximo mes', 'Sentirte culpable por semanas'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 5,
                        'text' => '¿Qué factor es más importante para el éxito de un hábito?',
                        'options' => ['Perfección', 'Consistencia', 'Velocidad', 'Complejidad'],
                        'correct_answer' => 1
                    ]
                ]),
                'points_per_question' => 10,
                'is_active' => true,
                'available_from' => Carbon::now(),
                'available_until' => Carbon::now()->addMonths(12),
                'locale' => 'es',
                'icon_path' => 'rocket'
            ]
        ];

        foreach ($quizzes as $quiz) {
            Quiz::create($quiz);
        }
    }
}
