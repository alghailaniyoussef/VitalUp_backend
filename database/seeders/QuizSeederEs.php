<?php

namespace Database\Seeders;

use App\Models\Quiz;
use Illuminate\Database\Seeder;

class QuizSeederEs extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Spanish quizzes
        $quizzes = [
            [
                'title' => 'Fundamentos del Bienestar Mental',
                'description' => 'Pon a prueba tus conocimientos sobre los conceptos básicos del bienestar mental y la salud psicológica.',
                'questions' => json_encode([
                    [
                        'id' => 1,
                        'text' => '¿Cuál de las siguientes NO es una práctica recomendada para el bienestar mental?',
                        'options' => [
                            'Meditación regular',
                            'Mantener un diario de gratitud',
                            'Evitar buscar ayuda profesional para problemas menores',
                            'Practicar técnicas de respiración profunda'
                        ],
                        'correct_answer' => 2,
                        'explanation' => 'Buscar ayuda profesional, incluso para problemas menores, es una práctica saludable para el bienestar mental. Ignorar los problemas puede llevar a que empeoren con el tiempo.'
                    ],
                    [
                        'id' => 2,
                        'text' => '¿Qué es la atención plena (mindfulness)?',
                        'options' => [
                            'La capacidad de hacer múltiples tareas a la vez',
                            'Prestar atención al momento presente sin juzgar',
                            'Planificar cuidadosamente el futuro',
                            'Recordar eventos pasados con precisión'
                        ],
                        'correct_answer' => 1,
                        'explanation' => 'La atención plena es la práctica de prestar atención al momento presente de manera intencional y sin juzgar, observando pensamientos y sensaciones tal como son.'
                    ],
                    [
                        'id' => 3,
                        'text' => '¿Cuál de los siguientes es un beneficio respaldado científicamente de la meditación regular?',
                        'options' => [
                            'Eliminación completa del estrés',
                            'Reducción de la presión arterial',
                            'Curación de todas las enfermedades mentales',
                            'Capacidad para predecir eventos futuros'
                        ],
                        'correct_answer' => 1,
                        'explanation' => 'Estudios científicos han demostrado que la meditación regular puede ayudar a reducir la presión arterial, entre otros beneficios para la salud como reducción del estrés y mejora del enfoque.'
                    ],
                    [
                        'id' => 4,
                        'text' => '¿Qué es la resiliencia emocional?',
                        'options' => [
                            'La capacidad de evitar todas las emociones negativas',
                            'La capacidad de recuperarse de la adversidad y adaptarse al cambio',
                            'La habilidad de ocultar tus verdaderos sentimientos',
                            'La tendencia a experimentar solo emociones positivas'
                        ],
                        'correct_answer' => 1,
                        'explanation' => 'La resiliencia emocional es la capacidad de adaptarse a situaciones estresantes o desafiantes y recuperarse de la adversidad y los traumas.'
                    ],
                    [
                        'id' => 5,
                        'text' => '¿Cuál de las siguientes actividades puede ayudar a reducir los síntomas de ansiedad?',
                        'options' => [
                            'Consumir más cafeína',
                            'Reducir las horas de sueño',
                            'Ejercicio físico regular',
                            'Pasar más tiempo en redes sociales'
                        ],
                        'correct_answer' => 2,
                        'explanation' => 'El ejercicio físico regular ha demostrado ser efectivo para reducir los síntomas de ansiedad al liberar endorfinas y otros neurotransmisores que mejoran el estado de ánimo.'
                    ]
                ]),
                'points_per_question' => 10,
                'is_active' => true,
                'locale' => 'es',
            ],
            [
                'title' => 'Nutrición y Bienestar',
                'description' => 'Evalúa tu comprensión de los principios básicos de nutrición y cómo afectan a tu bienestar general.',
                'questions' => json_encode([
                    [
                        'id' => 1,
                        'text' => '¿Cuál de los siguientes NO es un macronutriente?',
                        'options' => [
                            'Proteínas',
                            'Grasas',
                            'Vitaminas',
                            'Carbohidratos'
                        ],
                        'correct_answer' => 2,
                        'explanation' => 'Las vitaminas son micronutrientes, no macronutrientes. Los macronutrientes son nutrientes que el cuerpo necesita en grandes cantidades: proteínas, grasas y carbohidratos.'
                    ],
                    [
                        'id' => 2,
                        'text' => '¿Qué significa el término "dieta antiinflamatoria"?',
                        'options' => [
                            'Una dieta que elimina todos los carbohidratos',
                            'Una dieta que se enfoca en alimentos que reducen la inflamación en el cuerpo',
                            'Una dieta que solo incluye alimentos crudos',
                            'Una dieta que requiere ayuno intermitente'
                        ],
                        'correct_answer' => 1,
                        'explanation' => 'Una dieta antiinflamatoria se enfoca en consumir alimentos que ayudan a reducir la inflamación en el cuerpo, como frutas, verduras, grasas saludables y especias antiinflamatorias.'
                    ],
                    [
                        'id' => 3,
                        'text' => '¿Cuál es la recomendación general para el consumo diario de agua?',
                        'options' => [
                            'Al menos 8 vasos (aproximadamente 2 litros) para la mayoría de los adultos',
                            'Exactamente 1 litro para todos los adultos',
                            'Solo beber cuando se tiene sed',
                            'Al menos 4 litros para todos los adultos'
                        ],
                        'correct_answer' => 0,
                        'explanation' => 'La recomendación general es consumir aproximadamente 8 vasos (2 litros) de agua al día, aunque las necesidades individuales pueden variar según el peso, la actividad física y el clima.'
                    ],
                    [
                        'id' => 4,
                        'text' => '¿Qué son los probióticos?',
                        'options' => [
                            'Suplementos vitamínicos sintéticos',
                            'Microorganismos vivos que proporcionan beneficios para la salud cuando se consumen en cantidades adecuadas',
                            'Proteínas que ayudan a construir músculo',
                            'Carbohidratos complejos que proporcionan energía duradera'
                        ],
                        'correct_answer' => 1,
                        'explanation' => 'Los probióticos son microorganismos vivos (principalmente bacterias beneficiosas) que, cuando se consumen en cantidades adecuadas, proporcionan beneficios para la salud, especialmente para la digestión.'
                    ],
                    [
                        'id' => 5,
                        'text' => '¿Cuál de los siguientes alimentos es la mejor fuente de ácidos grasos omega-3?',
                        'options' => [
                            'Pollo',
                            'Arroz blanco',
                            'Pescado graso (como salmón o caballa)',
                            'Leche entera'
                        ],
                        'correct_answer' => 2,
                        'explanation' => 'Los pescados grasos como el salmón, la caballa y las sardinas son excelentes fuentes de ácidos grasos omega-3, que son importantes para la salud del corazón y el cerebro.'
                    ]
                ]),
                'points_per_question' => 10,
                'is_active' => true,
                'locale' => 'es',
            ],
            [
                'title' => 'Sostenibilidad y Vida Ecológica',
                'description' => 'Pon a prueba tus conocimientos sobre prácticas sostenibles y cómo vivir de manera más ecológica.',
                'questions' => json_encode([
                    [
                        'id' => 1,
                        'text' => '¿Cuál de las siguientes acciones tiene el MAYOR impacto positivo en la reducción de la huella de carbono personal?',
                        'options' => [
                            'Usar bolsas reutilizables para la compra',
                            'Reducir significativamente el consumo de carne',
                            'Apagar las luces cuando no se usan',
                            'Reciclar papel y plástico'
                        ],
                        'correct_answer' => 1,
                        'explanation' => 'Aunque todas estas acciones son beneficiosas, reducir significativamente el consumo de carne (especialmente carne de res) tiene el mayor impacto en la reducción de la huella de carbono personal debido a las altas emisiones asociadas con la ganadería.'
                    ],
                    [
                        'id' => 2,
                        'text' => '¿Qué significa el término "economía circular"?',
                        'options' => [
                            'Un sistema económico que solo utiliza monedas como medio de intercambio',
                            'Un modelo económico que prioriza el crecimiento continuo',
                            'Un sistema que minimiza los residuos y maximiza la reutilización de recursos',
                            'Una economía basada exclusivamente en energías renovables'
                        ],
                        'correct_answer' => 2,
                        'explanation' => 'La economía circular es un modelo económico que busca redefinir el crecimiento, centrándose en los beneficios positivos para toda la sociedad. Implica disociar la actividad económica del consumo de recursos finitos y eliminar los residuos del sistema.'
                    ],
                    [
                        'id' => 3,
                        'text' => '¿Cuál de los siguientes NO es un beneficio de la agricultura urbana?',
                        'options' => [
                            'Reducción de las millas de alimentos',
                            'Mejora de la calidad del aire',
                            'Aumento de la biodiversidad local',
                            'Eliminación de la necesidad de pesticidas'
                        ],
                        'correct_answer' => 3,
                        'explanation' => 'Aunque la agricultura urbana tiene muchos beneficios, no elimina automáticamente la necesidad de pesticidas. Incluso los jardines urbanos pueden enfrentar plagas y enfermedades, aunque se pueden utilizar métodos orgánicos y de control integrado de plagas.'
                    ],
                    [
                        'id' => 4,
                        'text' => '¿Qué es el "greenwashing"?',
                        'options' => [
                            'Una técnica para limpiar edificios con productos ecológicos',
                            'La práctica de hacer que un producto parezca más ecológico de lo que realmente es',
                            'Un método para purificar agua usando plantas',
                            'El proceso de convertir espacios urbanos en áreas verdes'
                        ],
                        'correct_answer' => 1,
                        'explanation' => 'El "greenwashing" es una forma de marketing engañoso donde una empresa gasta más tiempo y dinero en promocionarse como ecológica que en minimizar su impacto ambiental real.'
                    ],
                    [
                        'id' => 5,
                        'text' => '¿Cuál es el principal problema ambiental asociado con los microplásticos?',
                        'options' => [
                            'Son altamente inflamables',
                            'Emiten gases de efecto invernadero',
                            'Persisten en el medio ambiente y entran en la cadena alimentaria',
                            'Consumen grandes cantidades de agua durante su producción'
                        ],
                        'correct_answer' => 2,
                        'explanation' => 'Los microplásticos son extremadamente persistentes en el medio ambiente y pueden ser ingeridos por organismos marinos, entrando así en la cadena alimentaria. Pueden transportar contaminantes y representan una amenaza para la vida silvestre y potencialmente para la salud humana.'
                    ]
                ]),
                'points_per_question' => 10,
                'is_active' => true,
                'locale' => 'es',
            ],
            [
                'title' => 'Inteligencia Financiera',
                'description' => 'Evalúa tu conocimiento sobre conceptos financieros básicos y hábitos de dinero inteligentes.',
                'questions' => json_encode([
                    [
                        'id' => 1,
                        'text' => '¿Qué es un presupuesto de base cero?',
                        'options' => [
                            'Un presupuesto donde no gastas nada',
                            'Un presupuesto donde justificas cada gasto desde cero cada período',
                            'Un presupuesto que solo incluye gastos esenciales',
                            'Un presupuesto donde ahorras el 100% de tus ingresos'
                        ],
                        'correct_answer' => 1,
                        'explanation' => 'Un presupuesto de base cero es un método donde justificas todos los gastos para cada nuevo período, comenzando desde cero, en lugar de basar tu presupuesto en el del período anterior.'
                    ],
                    [
                        'id' => 2,
                        'text' => '¿Cuál es la regla 50/30/20 para el presupuesto personal?',
                        'options' => [
                            '50% para inversiones, 30% para gastos, 20% para ahorros',
                            '50% para necesidades, 30% para deseos, 20% para ahorros y deudas',
                            '50% para impuestos, 30% para vivienda, 20% para todo lo demás',
                            '50% para alimentos, 30% para transporte, 20% para entretenimiento'
                        ],
                        'correct_answer' => 1,
                        'explanation' => 'La regla 50/30/20 sugiere asignar el 50% de tus ingresos después de impuestos a necesidades, el 30% a deseos y el 20% a ahorros y pago de deudas.'
                    ],
                    [
                        'id' => 3,
                        'text' => '¿Qué es el interés compuesto?',
                        'options' => [
                            'Un tipo de préstamo con tasas de interés muy altas',
                            'Interés que se calcula solo sobre el capital inicial',
                            'Interés que se calcula sobre el capital inicial más el interés acumulado',
                            'Un bono que pagan los bancos por mantener grandes sumas de dinero'
                        ],
                        'correct_answer' => 2,
                        'explanation' => 'El interés compuesto es el interés que se calcula no solo sobre el capital inicial sino también sobre el interés acumulado de períodos anteriores. Es a menudo descrito como "interés sobre interés".'
                    ],
                    [
                        'id' => 4,
                        'text' => '¿Cuál de las siguientes NO es generalmente una buena estrategia para la salud financiera?',
                        'options' => [
                            'Mantener un fondo de emergencia',
                            'Diversificar inversiones',
                            'Usar el crédito para compras diarias y pagar solo el mínimo',
                            'Contribuir regularmente a un plan de jubilación'
                        ],
                        'correct_answer' => 2,
                        'explanation' => 'Usar tarjetas de crédito para gastos diarios y pagar solo el mínimo cada mes puede llevar a acumular deudas significativas debido a las altas tasas de interés, afectando negativamente tu salud financiera a largo plazo.'
                    ],
                    [
                        'id' => 5,
                        'text' => '¿Qué es la inflación?',
                        'options' => [
                            'El aumento en el valor de una moneda',
                            'El aumento general en los precios y la caída en el poder adquisitivo del dinero',
                            'La tasa a la que aumentan los salarios',
                            'El proceso de invertir en múltiples clases de activos'
                        ],
                        'correct_answer' => 1,
                        'explanation' => 'La inflación es el aumento general en los precios de bienes y servicios en una economía a lo largo del tiempo, lo que resulta en una disminución del poder adquisitivo de la moneda.'
                    ]
                ]),
                'points_per_question' => 10,
                'is_active' => true,
                'locale' => 'es',
            ],
            [
                'title' => 'Conexiones Sociales Saludables',
                'description' => 'Evalúa tu comprensión de las relaciones saludables y las habilidades de comunicación efectiva.',
                'questions' => json_encode([
                    [
                        'id' => 1,
                        'text' => '¿Cuál de las siguientes es una característica de la escucha activa?',
                        'options' => [
                            'Interrumpir para mostrar entusiasmo',
                            'Formular tu respuesta mientras la otra persona habla',
                            'Parafrasear lo que has escuchado para verificar la comprensión',
                            'Cambiar rápidamente el tema a algo relacionado contigo'
                        ],
                        'correct_answer' => 2,
                        'explanation' => 'La escucha activa implica prestar plena atención al hablante y parafrasear o resumir lo que has escuchado para verificar que has entendido correctamente, mostrando que valoras lo que la otra persona está comunicando.'
                    ],
                    [
                        'id' => 2,
                        'text' => '¿Qué es la inteligencia emocional?',
                        'options' => [
                            'La capacidad de manipular las emociones de los demás',
                            'La capacidad de suprimir todas las emociones negativas',
                            'La capacidad de reconocer, entender y manejar tus propias emociones y las de los demás',
                            'Un término científico para el coeficiente intelectual (CI)'
                        ],
                        'correct_answer' => 2,
                        'explanation' => 'La inteligencia emocional es la capacidad de reconocer, entender y manejar nuestras propias emociones, así como reconocer, entender e influir en las emociones de los demás. Es crucial para las relaciones interpersonales efectivas.'
                    ],
                    [
                        'id' => 3,
                        'text' => '¿Cuál de las siguientes es una señal de una relación saludable?',
                        'options' => [
                            'Uno de los socios toma todas las decisiones importantes',
                            'Los socios mantienen secretos importantes entre sí',
                            'Los socios respetan los límites y la autonomía del otro',
                            'Los socios evitan todos los conflictos y desacuerdos'
                        ],
                        'correct_answer' => 2,
                        'explanation' => 'En las relaciones saludables, los socios respetan los límites y la autonomía del otro, permitiendo espacio para la individualidad mientras mantienen una conexión fuerte. El respeto mutuo es fundamental para una relación saludable.'
                    ],
                    [
                        'id' => 4,
                        'text' => '¿Qué es la comunicación asertiva?',
                        'options' => [
                            'Comunicar tus necesidades y límites de manera clara y respetuosa',
                            'Siempre estar de acuerdo con los demás para evitar conflictos',
                            'Usar un tono agresivo para asegurarte de que te escuchen',
                            'Comunicar indirectamente a través de insinuaciones y pistas'
                        ],
                        'correct_answer' => 0,
                        'explanation' => 'La comunicación asertiva implica expresar tus pensamientos, sentimientos, necesidades y límites de manera directa, honesta y respetuosa, mientras también respetas los derechos y límites de los demás.'
                    ],
                    [
                        'id' => 5,
                        'text' => '¿Cuál de las siguientes NO es una estrategia efectiva para resolver conflictos?',
                        'options' => [
                            'Practicar la escucha activa',
                            'Usar declaraciones "yo" en lugar de acusaciones',
                            'Esperar a que te calmes antes de abordar el problema',
                            'Involucrar a otras personas para que tomen partido'
                        ],
                        'correct_answer' => 3,
                        'explanation' => 'Involucrar a otros para que tomen partido en un conflicto generalmente lo escala y complica, en lugar de resolverlo. La resolución efectiva de conflictos se centra en la comunicación directa y respetuosa entre las partes involucradas.'
                    ]
                ]),
                'points_per_question' => 10,
                'is_active' => true,
                'locale' => 'es',
            ],
            [
                'title' => 'Fundamentos de Ejercicio Físico',
                'description' => 'Aprende sobre los principios del ejercicio, componentes de la aptitud física y patrones de movimiento saludables.',
                'questions' => json_encode([
                    [
                        'id' => 1,
                        'text' => '¿Cuál es la frecuencia recomendada de ejercicio cardiovascular para adultos?',
                        'options' => [
                            'Una vez por semana',
                            'Al menos 150 minutos de intensidad moderada por semana',
                            'Solo los fines de semana',
                            'Todos los días durante 2 horas'
                        ],
                        'correct_answer' => 1,
                        'explanation' => 'Los adultos deben realizar al menos 150 minutos de actividad aeróbica de intensidad moderada por semana, según las recomendaciones de salud.'
                    ],
                    [
                        'id' => 2,
                        'text' => '¿Qué tipo de ejercicio es mejor para fortalecer los huesos?',
                        'options' => [
                            'Natación',
                            'Ejercicios de resistencia con pesas',
                            'Yoga suave',
                            'Ciclismo'
                        ],
                        'correct_answer' => 1,
                        'explanation' => 'Los ejercicios de resistencia con pesas son especialmente efectivos para fortalecer los huesos y prevenir la osteoporosis.'
                    ],
                    [
                        'id' => 3,
                        'text' => '¿Cuánto tiempo debe durar un calentamiento antes del ejercicio?',
                        'options' => [
                            '2-3 minutos',
                            '5-10 minutos',
                            '15-20 minutos',
                            'No es necesario calentar'
                        ],
                        'correct_answer' => 1,
                        'explanation' => 'Un calentamiento de 5-10 minutos es ideal para preparar el cuerpo para el ejercicio y reducir el riesgo de lesiones.'
                    ]
                ]),
                'points_per_question' => 10,
                'is_active' => true,
                'locale' => 'es',
            ],
            [
                'title' => 'Ciencia del Sueño y Recuperación',
                'description' => 'Aprende sobre los ciclos del sueño, procesos de recuperación y cómo optimizar el descanso para una mejor salud.',
                'questions' => json_encode([
                    [
                        'id' => 1,
                        'text' => '¿Cuántas horas de sueño necesitan la mayoría de los adultos por noche?',
                        'options' => [
                            '5-6 horas',
                            '7-9 horas',
                            '10-12 horas',
                            '4-5 horas'
                        ],
                        'correct_answer' => 1,
                        'explanation' => 'La mayoría de los adultos necesitan entre 7-9 horas de sueño por noche para un funcionamiento óptimo.'
                    ],
                    [
                        'id' => 2,
                        'text' => '¿Qué fase del sueño es más importante para la consolidación de la memoria?',
                        'options' => [
                            'Sueño ligero',
                            'Sueño REM',
                            'Despertar',
                            'Transición al sueño'
                        ],
                        'correct_answer' => 1,
                        'explanation' => 'El sueño REM es crucial para la consolidación de la memoria y el procesamiento emocional.'
                    ],
                    [
                        'id' => 3,
                        'text' => '¿Cuál es el mejor momento para evitar la cafeína si quieres dormir bien?',
                        'options' => [
                            '1 hora antes de dormir',
                            '6-8 horas antes de dormir',
                            'Solo por la mañana',
                            'No importa el momento'
                        ],
                        'correct_answer' => 1,
                        'explanation' => 'La cafeína puede permanecer en el sistema durante 6-8 horas, por lo que es mejor evitarla en ese período antes de dormir.'
                    ]
                ]),
                'points_per_question' => 10,
                'is_active' => true,
                'locale' => 'es',
            ],
            [
                'title' => 'Bienestar Ambiental',
                'description' => 'Comprende cómo los factores ambientales impactan la salud y aprende prácticas de vida sostenible.',
                'questions' => json_encode([
                    [
                        'id' => 1,
                        'text' => '¿Cuál de las siguientes acciones tiene el mayor impacto en la reducción de la huella de carbono personal?',
                        'options' => [
                            'Reciclar papel',
                            'Reducir el consumo de carne',
                            'Usar bombillas LED',
                            'Tomar duchas más cortas'
                        ],
                        'correct_answer' => 1,
                        'explanation' => 'Reducir el consumo de carne, especialmente carne roja, tiene uno de los mayores impactos en la reducción de la huella de carbono personal.'
                    ],
                    [
                        'id' => 2,
                        'text' => '¿Qué porcentaje del aire interior puede estar más contaminado que el aire exterior?',
                        'options' => [
                            'El aire interior siempre es más limpio',
                            '2-5 veces más contaminado',
                            'Igual de contaminado',
                            'Solo en invierno'
                        ],
                        'correct_answer' => 1,
                        'explanation' => 'El aire interior puede estar 2-5 veces más contaminado que el aire exterior debido a productos químicos, polvo y falta de ventilación.'
                    ],
                    [
                        'id' => 3,
                        'text' => '¿Cuál es una forma efectiva de mejorar la calidad del aire interior?',
                        'options' => [
                            'Usar más productos de limpieza',
                            'Mantener las ventanas siempre cerradas',
                            'Añadir plantas purificadoras de aire',
                            'Usar ambientadores sintéticos'
                        ],
                        'correct_answer' => 2,
                        'explanation' => 'Las plantas como la sansevieria, pothos y peace lily pueden ayudar a purificar el aire interior de forma natural.'
                    ]
                ]),
                'points_per_question' => 10,
                'is_active' => true,
                'locale' => 'es',
            ]
        ];

        foreach ($quizzes as $quiz) {
            Quiz::create($quiz);
        }
    }
}
