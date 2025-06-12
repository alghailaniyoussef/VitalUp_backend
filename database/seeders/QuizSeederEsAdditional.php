<?php

namespace Database\Seeders;

use App\Models\Quiz;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class QuizSeederEsAdditional extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // VitalUp Professional Wellness Quizzes - Spanish (Additional 15)
        $quizzes = [
            [
                'title' => 'Salud Digestiva',
                'description' => 'Comprende los fundamentos de la salud digestiva y cómo mantener un sistema digestivo saludable.',
                'questions' => json_encode([
                    [
                        'id' => 1,
                        'text' => '¿Qué alimento es mejor para la salud intestinal?',
                        'options' => ['Alimentos procesados', 'Yogur con probióticos', 'Comida rápida', 'Bebidas azucaradas'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 2,
                        'text' => '¿Cuánta fibra deben consumir los adultos diariamente?',
                        'options' => ['10-15 gramos', '25-35 gramos', '50-60 gramos', '5-10 gramos'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 3,
                        'text' => '¿Qué práctica mejora la digestión?',
                        'options' => ['Comer rápidamente', 'Masticar bien los alimentos', 'Beber mucha agua durante las comidas', 'Saltarse comidas'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 4,
                        'text' => '¿Cuál es una señal de un intestino saludable?',
                        'options' => ['Estreñimiento frecuente', 'Movimientos intestinales regulares', 'Hinchazón constante', 'Dolor abdominal'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 5,
                        'text' => '¿Qué puede dañar la flora intestinal?',
                        'options' => ['Probióticos', 'Antibióticos excesivos', 'Verduras', 'Ejercicio'],
                        'correct_answer' => 1
                    ]
                ]),
                'points_per_question' => 10,
                'is_active' => true,
                'available_from' => Carbon::now(),
                'available_until' => Carbon::now()->addMonths(12),
                'locale' => 'es',
                'icon_path' => 'diamond'
            ],
            [
                'title' => 'Salud Cardiovascular',
                'description' => 'Aprende sobre la salud del corazón y estrategias para mantener un sistema cardiovascular fuerte.',
                'questions' => json_encode([
                    [
                        'id' => 1,
                        'text' => '¿Cuál es un factor de riesgo para enfermedades cardíacas?',
                        'options' => ['Ejercicio regular', 'Fumar', 'Comer frutas', 'Dormir bien'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 2,
                        'text' => '¿Qué tipo de grasa es mejor para la salud del corazón?',
                        'options' => ['Grasas trans', 'Grasas saturadas', 'Grasas monoinsaturadas', 'Margarina'],
                        'correct_answer' => 2
                    ],
                    [
                        'id' => 3,
                        'text' => '¿Cuál es la presión arterial normal?',
                        'options' => ['140/90 mmHg', '120/80 mmHg', '160/100 mmHg', '100/60 mmHg'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 4,
                        'text' => '¿Qué ejercicio es mejor para el corazón?',
                        'options' => ['Solo levantamiento de pesas', 'Ejercicio aeróbico', 'Solo estiramientos', 'Ejercicios isométricos'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 5,
                        'text' => '¿Cuántos minutos de ejercicio cardiovascular se recomiendan por semana?',
                        'options' => ['75 minutos', '150 minutos', '300 minutos', '30 minutos'],
                        'correct_answer' => 1
                    ]
                ]),
                'points_per_question' => 10,
                'is_active' => true,
                'available_from' => Carbon::now(),
                'available_until' => Carbon::now()->addMonths(12),
                'locale' => 'es',
                'icon_path' => 'fire'
            ],
            [
                'title' => 'Gestión de Energía Personal',
                'description' => 'Descubre cómo optimizar tus niveles de energía a lo largo del día para un rendimiento máximo.',
                'questions' => json_encode([
                    [
                        'id' => 1,
                        'text' => '¿Cuál es la mejor manera de mantener energía estable?',
                        'options' => ['Comer azúcar', 'Comidas balanceadas regulares', 'Saltarse comidas', 'Solo cafeína'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 2,
                        'text' => '¿Qué causa la caída de energía por la tarde?',
                        'options' => ['Ritmo circadiano natural', 'Demasiado ejercicio', 'Mucha agua', 'Aire fresco'],
                        'correct_answer' => 0
                    ],
                    [
                        'id' => 3,
                        'text' => '¿Cuál es una forma natural de aumentar la energía?',
                        'options' => ['Bebidas energéticas', 'Ejercicio ligero', 'Más azúcar', 'Dormir más de 10 horas'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 4,
                        'text' => '¿Qué nutriente es esencial para la producción de energía?',
                        'options' => ['Vitaminas B', 'Vitamina C', 'Vitamina D', 'Vitamina A'],
                        'correct_answer' => 0
                    ],
                    [
                        'id' => 5,
                        'text' => '¿Cuándo es mejor tomar una siesta?',
                        'options' => ['Temprano en la mañana', '20-30 minutos por la tarde', 'Justo antes de dormir', 'Por 2 horas'],
                        'correct_answer' => 1
                    ]
                ]),
                'points_per_question' => 10,
                'is_active' => true,
                'available_from' => Carbon::now(),
                'available_until' => Carbon::now()->addMonths(12),
                'locale' => 'es',
                'icon_path' => 'book'
            ],
            [
                'title' => 'Salud Mental en el Trabajo',
                'description' => 'Estrategias para mantener el bienestar mental en el ambiente laboral y manejar el estrés profesional.',
                'questions' => json_encode([
                    [
                        'id' => 1,
                        'text' => '¿Qué es el síndrome de burnout?',
                        'options' => ['Exceso de energía', 'Agotamiento físico y emocional', 'Motivación extrema', 'Hiperactividad'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 2,
                        'text' => '¿Cómo puedes manejar el estrés laboral?',
                        'options' => ['Trabajar más horas', 'Tomar descansos regulares', 'Evitar colegas', 'Saltarse el almuerzo'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 3,
                        'text' => '¿Qué práctica ayuda con la concentración en el trabajo?',
                        'options' => ['Multitarea constante', 'Técnica Pomodoro', 'Distracciones frecuentes', 'Trabajar sin parar'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 4,
                        'text' => '¿Cuál es una señal de estrés laboral?',
                        'options' => ['Mayor productividad', 'Irritabilidad frecuente', 'Mejor sueño', 'Más energía'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 5,
                        'text' => '¿Qué puede mejorar el ambiente de trabajo?',
                        'options' => ['Competencia tóxica', 'Comunicación abierta', 'Aislamiento', 'Críticas constantes'],
                        'correct_answer' => 1
                    ]
                ]),
                'points_per_question' => 10,
                'is_active' => true,
                'available_from' => Carbon::now(),
                'available_until' => Carbon::now()->addMonths(12),
                'locale' => 'es',
                'icon_path' => 'graduation'
            ],
            [
                'title' => 'Prevención de Lesiones',
                'description' => 'Aprende técnicas y estrategias para prevenir lesiones durante el ejercicio y actividades diarias.',
                'questions' => json_encode([
                    [
                        'id' => 1,
                        'text' => '¿Cuál es la causa más común de lesiones deportivas?',
                        'options' => ['Calentamiento insuficiente', 'Demasiada hidratación', 'Ejercicio lento', 'Descanso excesivo'],
                        'correct_answer' => 0
                    ],
                    [
                        'id' => 2,
                        'text' => '¿Qué debes hacer si sientes dolor durante el ejercicio?',
                        'options' => ['Continuar ejercitándote', 'Parar y evaluar', 'Ejercitarte más fuerte', 'Ignorar el dolor'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 3,
                        'text' => '¿Cuál es la regla RICE para lesiones?',
                        'options' => ['Correr, Saltar, Comprimir, Elevar', 'Descansar, Hielo, Comprimir, Elevar', 'Relajar, Ignorar, Continuar, Ejercitar', 'Repetir, Intensificar, Competir, Entrenar'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 4,
                        'text' => '¿Qué tipo de calzado es mejor para correr?',
                        'options' => ['Zapatos de vestir', 'Sandalias', 'Zapatos deportivos apropiados', 'Zapatos de tacón'],
                        'correct_answer' => 2
                    ],
                    [
                        'id' => 5,
                        'text' => '¿Cuándo debes buscar ayuda médica por una lesión?',
                        'options' => ['Nunca', 'Solo si hay fractura visible', 'Si el dolor persiste o empeora', 'Solo después de una semana'],
                        'correct_answer' => 2
                    ]
                ]),
                'points_per_question' => 10,
                'is_active' => true,
                'available_from' => Carbon::now(),
                'available_until' => Carbon::now()->addMonths(12),
                'locale' => 'es',
                'icon_path' => 'checkmark'
            ],
            [
                'title' => 'Suplementos y Vitaminas',
                'description' => 'Comprende el papel de los suplementos en la salud y cuándo pueden ser necesarios.',
                'questions' => json_encode([
                    [
                        'id' => 1,
                        'text' => '¿Cuál es la mejor fuente de vitaminas?',
                        'options' => ['Suplementos sintéticos', 'Alimentos integrales', 'Bebidas energéticas', 'Comida procesada'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 2,
                        'text' => '¿Qué vitamina se produce con la exposición al sol?',
                        'options' => ['Vitamina A', 'Vitamina C', 'Vitamina D', 'Vitamina E'],
                        'correct_answer' => 2
                    ],
                    [
                        'id' => 3,
                        'text' => '¿Cuándo pueden ser necesarios los suplementos?',
                        'options' => ['Siempre', 'Nunca', 'Cuando hay deficiencias diagnosticadas', 'Solo para atletas'],
                        'correct_answer' => 2
                    ],
                    [
                        'id' => 4,
                        'text' => '¿Qué mineral es importante para los huesos?',
                        'options' => ['Hierro', 'Calcio', 'Zinc', 'Magnesio'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 5,
                        'text' => '¿Qué puede causar el exceso de suplementos?',
                        'options' => ['Mejor salud', 'Toxicidad', 'Más energía', 'Pérdida de peso'],
                        'correct_answer' => 1
                    ]
                ]),
                'points_per_question' => 10,
                'is_active' => true,
                'available_from' => Carbon::now(),
                'available_until' => Carbon::now()->addMonths(12),
                'locale' => 'es',
                'icon_path' => 'medal'
            ],
            [
                'title' => 'Tecnología y Bienestar',
                'description' => 'Explora la relación entre la tecnología y la salud, y cómo usar la tecnología de manera saludable.',
                'questions' => json_encode([
                    [
                        'id' => 1,
                        'text' => '¿Qué es la fatiga visual digital?',
                        'options' => ['Mejor visión', 'Cansancio ocular por pantallas', 'Visión nocturna mejorada', 'Daltonismo'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 2,
                        'text' => '¿Cuál es la regla 20-20-20 para la salud ocular?',
                        'options' => ['Mirar 20 metros por 20 segundos cada 20 minutos', 'Parpadear 20 veces en 20 segundos', 'Usar pantallas 20 horas al día', 'Descansar 20 minutos cada hora'],
                        'correct_answer' => 0
                    ],
                    [
                        'id' => 3,
                        'text' => '¿Cómo afecta la luz azul al sueño?',
                        'options' => ['Mejora el sueño', 'Puede interferir con el sueño', 'No tiene efecto', 'Causa somnolencia'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 4,
                        'text' => '¿Qué es una postura ergonómica?',
                        'options' => ['Encorvarse', 'Posición que reduce la tensión corporal', 'Estar de pie todo el día', 'Sentarse sin apoyo'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 5,
                        'text' => '¿Cuánto tiempo debes pasar sin pantallas antes de dormir?',
                        'options' => ['5 minutos', '1-2 horas', '30 segundos', 'No importa'],
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
                'title' => 'Salud de la Piel',
                'description' => 'Aprende sobre el cuidado de la piel y factores que afectan la salud cutánea.',
                'questions' => json_encode([
                    [
                        'id' => 1,
                        'text' => '¿Cuál es el factor más importante para la salud de la piel?',
                        'options' => ['Productos caros', 'Protección solar', 'Maquillaje', 'Perfumes'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 2,
                        'text' => '¿Qué SPF se recomienda para uso diario?',
                        'options' => ['SPF 5', 'SPF 30 o más', 'SPF 10', 'No es necesario'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 3,
                        'text' => '¿Qué nutriente es importante para la salud de la piel?',
                        'options' => ['Vitamina C', 'Cafeína', 'Azúcar', 'Alcohol'],
                        'correct_answer' => 0
                    ],
                    [
                        'id' => 4,
                        'text' => '¿Cómo afecta el estrés a la piel?',
                        'options' => ['La mejora', 'Puede causar brotes', 'No tiene efecto', 'La hace más joven'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 5,
                        'text' => '¿Cuál es la mejor manera de limpiar la piel?',
                        'options' => ['Frotar vigorosamente', 'Limpieza suave', 'Usar jabón fuerte', 'No limpiar'],
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
                'title' => 'Salud Respiratoria',
                'description' => 'Comprende la importancia de la salud pulmonar y técnicas de respiración para el bienestar.',
                'questions' => json_encode([
                    [
                        'id' => 1,
                        'text' => '¿Qué ejercicio mejora la capacidad pulmonar?',
                        'options' => ['Solo levantamiento de pesas', 'Ejercicio cardiovascular', 'Solo estiramientos', 'Ejercicios de brazos'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 2,
                        'text' => '¿Cuál es una técnica de respiración para relajarse?',
                        'options' => ['Respiración rápida', 'Respiración diafragmática', 'Contener la respiración', 'Respirar por la boca'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 3,
                        'text' => '¿Qué contamina más el aire interior?',
                        'options' => ['Plantas', 'Productos de limpieza químicos', 'Agua', 'Libros'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 4,
                        'text' => '¿Cuántas respiraciones por minuto son normales en reposo?',
                        'options' => ['5-8', '12-20', '30-40', '50-60'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 5,
                        'text' => '¿Qué beneficio tiene la respiración profunda?',
                        'options' => ['Aumenta el estrés', 'Reduce la relajación', 'Activa el sistema nervioso parasimpático', 'Causa ansiedad'],
                        'correct_answer' => 2
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
                'title' => 'Salud Hormonal',
                'description' => 'Explora el sistema endocrino y cómo mantener un equilibrio hormonal saludable.',
                'questions' => json_encode([
                    [
                        'id' => 1,
                        'text' => '¿Qué hormona regula el sueño?',
                        'options' => ['Insulina', 'Melatonina', 'Adrenalina', 'Cortisol'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 2,
                        'text' => '¿Qué puede alterar el equilibrio hormonal?',
                        'options' => ['Ejercicio regular', 'Estrés crónico', 'Sueño adecuado', 'Alimentación balanceada'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 3,
                        'text' => '¿Cuál es la hormona del estrés?',
                        'options' => ['Insulina', 'Serotonina', 'Cortisol', 'Melatonina'],
                        'correct_answer' => 2
                    ],
                    [
                        'id' => 4,
                        'text' => '¿Qué práctica ayuda a regular las hormonas?',
                        'options' => ['Privación de sueño', 'Ejercicio regular', 'Estrés constante', 'Ayuno extremo'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 5,
                        'text' => '¿Qué alimento puede afectar negativamente las hormonas?',
                        'options' => ['Verduras', 'Azúcar procesado', 'Frutas', 'Nueces'],
                        'correct_answer' => 1
                    ]
                ]),
                'points_per_question' => 10,
                'is_active' => true,
                'available_from' => Carbon::now(),
                'available_until' => Carbon::now()->addMonths(12),
                'locale' => 'es',
                'icon_path' => 'fire'
            ],
            [
                'title' => 'Longevidad y Envejecimiento Saludable',
                'description' => 'Descubre estrategias para envejecer de manera saludable y promover la longevidad.',
                'questions' => json_encode([
                    [
                        'id' => 1,
                        'text' => '¿Qué factor es más importante para la longevidad?',
                        'options' => ['Genética únicamente', 'Estilo de vida saludable', 'Suerte', 'Medicamentos'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 2,
                        'text' => '¿Qué práctica puede ralentizar el envejecimiento?',
                        'options' => ['Fumar', 'Ejercicio regular', 'Estrés crónico', 'Aislamiento social'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 3,
                        'text' => '¿Qué son los antioxidantes?',
                        'options' => ['Sustancias que aceleran el envejecimiento', 'Compuestos que protegen contra el daño celular', 'Vitaminas sintéticas', 'Medicamentos'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 4,
                        'text' => '¿Cuál es importante para mantener la función cerebral?',
                        'options' => ['Aislamiento', 'Aprendizaje continuo', 'Evitar desafíos', 'Rutina rígida'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 5,
                        'text' => '¿Qué tipo de dieta se asocia con mayor longevidad?',
                        'options' => ['Dieta alta en procesados', 'Dieta mediterránea', 'Dieta alta en azúcar', 'Dieta restrictiva extrema'],
                        'correct_answer' => 1
                    ]
                ]),
                'points_per_question' => 10,
                'is_active' => true,
                'available_from' => Carbon::now(),
                'available_until' => Carbon::now()->addMonths(12),
                'locale' => 'es',
                'icon_path' => 'diamond'
            ],
            [
                'title' => 'Salud Inmunológica',
                'description' => 'Comprende cómo funciona el sistema inmunológico y cómo fortalecerlo naturalmente.',
                'questions' => json_encode([
                    [
                        'id' => 1,
                        'text' => '¿Qué vitamina es crucial para el sistema inmune?',
                        'options' => ['Vitamina A', 'Vitamina C', 'Vitamina E', 'Todas las anteriores'],
                        'correct_answer' => 3
                    ],
                    [
                        'id' => 2,
                        'text' => '¿Qué debilita el sistema inmunológico?',
                        'options' => ['Ejercicio moderado', 'Sueño adecuado', 'Estrés crónico', 'Alimentación balanceada'],
                        'correct_answer' => 2
                    ],
                    [
                        'id' => 3,
                        'text' => '¿Dónde se encuentra la mayor parte del sistema inmune?',
                        'options' => ['Cerebro', 'Intestino', 'Corazón', 'Pulmones'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 4,
                        'text' => '¿Qué práctica fortalece la inmunidad?',
                        'options' => ['Privación de sueño', 'Ejercicio regular', 'Estrés constante', 'Dieta restrictiva'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 5,
                        'text' => '¿Qué alimento es bueno para la inmunidad?',
                        'options' => ['Comida procesada', 'Ajo', 'Azúcar refinado', 'Alcohol'],
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
                'title' => 'Bienestar Social',
                'description' => 'Explora la importancia de las conexiones sociales para la salud mental y física.',
                'questions' => json_encode([
                    [
                        'id' => 1,
                        'text' => '¿Cómo afecta el aislamiento social a la salud?',
                        'options' => ['La mejora', 'Puede ser perjudicial', 'No tiene efecto', 'Solo afecta a los ancianos'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 2,
                        'text' => '¿Qué beneficio tienen las relaciones sociales fuertes?',
                        'options' => ['Aumentan el estrés', 'Mejoran la longevidad', 'Causan ansiedad', 'Reducen la inmunidad'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 3,
                        'text' => '¿Qué es la empatía?',
                        'options' => ['Ignorar a otros', 'Comprender los sentimientos de otros', 'Ser egoísta', 'Evitar emociones'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 4,
                        'text' => '¿Cómo puedes mejorar tus habilidades sociales?',
                        'options' => ['Evitar a las personas', 'Practicar la escucha activa', 'Ser crítico', 'Aislarse'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 5,
                        'text' => '¿Qué actividad promueve el bienestar social?',
                        'options' => ['Aislamiento', 'Voluntariado', 'Competencia tóxica', 'Crítica constante'],
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
                'title' => 'Creatividad y Bienestar',
                'description' => 'Descubre cómo las actividades creativas contribuyen al bienestar mental y emocional.',
                'questions' => json_encode([
                    [
                        'id' => 1,
                        'text' => '¿Cómo beneficia la creatividad a la salud mental?',
                        'options' => ['Aumenta el estrés', 'Reduce el estrés', 'Causa ansiedad', 'No tiene efecto'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 2,
                        'text' => '¿Qué actividad creativa puede mejorar el estado de ánimo?',
                        'options' => ['Criticar arte', 'Pintar o dibujar', 'Ver televisión', 'Dormir'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 3,
                        'text' => '¿Qué es la terapia de arte?',
                        'options' => ['Criticar arte', 'Usar creatividad para sanación', 'Vender arte', 'Coleccionar arte'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 4,
                        'text' => '¿Cómo puede la música afectar el bienestar?',
                        'options' => ['Solo negativamente', 'Puede mejorar el estado de ánimo', 'No tiene efecto', 'Siempre causa estrés'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 5,
                        'text' => '¿Qué beneficio tiene escribir un diario?',
                        'options' => ['Aumenta la confusión', 'Ayuda a procesar emociones', 'Causa estrés', 'Pierde tiempo'],
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