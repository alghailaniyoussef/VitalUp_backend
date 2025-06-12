<?php

namespace Database\Seeders;

use App\Models\Challenge;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ChallengeSeederEs extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // VitalUp Professional Wellness Challenges - Spanish
        $challenges = [
            [
                'title' => 'Rutina Matutina Consciente',
                'description' => 'Establece una rutina matutina consistente que marque un tono positivo para todo tu día. Enfócate en la atención plena, el movimiento y la preparación mental.',
                'category' => 'mental',
                'difficulty' => 'beginner',
                'goals' => json_encode([
                    'Despertarse 30 minutos más temprano cada día',
                    'Practicar 10 minutos de meditación o respiración profunda',
                    'Escribir 3 cosas por las que estás agradecido',
                    'Hacer 5 minutos de estiramientos ligeros',
                    'Establecer intenciones y prioridades diarias'
                ]),
                'duration_days' => 21,
                'points_reward' => 180,
                'badge_rewards' => json_encode(['Maestro Matutino']),
                'is_active' => true,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addMonths(6),
                'locale' => 'es',
            ],
            [
                'title' => 'Desafío Héroe de la Hidratación',
                'description' => 'Transforma tu salud manteniendo niveles óptimos de hidratación durante todo el día. Rastrea tu consumo de agua y desarrolla hábitos saludables de bebida.',
                'category' => 'nutrition',
                'difficulty' => 'beginner',
                'goals' => json_encode([
                    'Beber 8 vasos de agua diariamente',
                    'Comenzar cada día con un vaso de agua',
                    'Reemplazar una bebida azucarada con agua diariamente',
                    'Usar una botella de agua reutilizable consistentemente',
                    'Rastrear los niveles de hidratación por 2 semanas'
                ]),
                'duration_days' => 14,
                'points_reward' => 150,
                'badge_rewards' => json_encode(['Héroe de la Hidratación']),
                'is_active' => true,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addMonths(6),
                'locale' => 'es',
            ],
            [
                'title' => 'Fin de Semana de Desintoxicación Digital',
                'description' => 'Recupera tu espacio mental y mejora el enfoque reduciendo el tiempo de pantalla y las distracciones digitales durante los fines de semana.',
                'category' => 'mental',
                'difficulty' => 'intermediate',
                'goals' => json_encode([
                    'Sin redes sociales por 48 horas',
                    'Apagar notificaciones no esenciales',
                    'Participar en actividades offline por 4+ horas diarias',
                    'Practicar alimentación consciente sin pantallas',
                    'Leer un libro físico por 1 hora'
                ]),
                'duration_days' => 7,
                'points_reward' => 200,
                'badge_rewards' => json_encode(['Campeón de Desintoxicación Digital']),
                'is_active' => true,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addMonths(6),
                'locale' => 'es',
            ],
            [
                'title' => 'Desafío de Transporte Activo',
                'description' => 'Incorpora más actividad física en tu rutina diaria eligiendo métodos de transporte activos.',
                'category' => 'fitness',
                'difficulty' => 'beginner',
                'goals' => json_encode([
                    'Caminar o ir en bicicleta al trabajo 3 veces por semana',
                    'Tomar escaleras en lugar de ascensores',
                    'Estacionar más lejos para aumentar la caminata',
                    'Bajarse del transporte público una parada antes',
                    'Rastrear pasos diarios y apuntar a 8,000+'
                ]),
                'duration_days' => 21,
                'points_reward' => 170,
                'badge_rewards' => json_encode(['Viajero Activo']),
                'is_active' => true,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addMonths(6),
                'locale' => 'es',
            ],
            [
                'title' => 'Optimización del Sueño Sin Estrés',
                'description' => 'Mejora la calidad de tu sueño y establece rutinas saludables para la hora de dormir para un mejor descanso y recuperación.',
                'category' => 'sleep',
                'difficulty' => 'intermediate',
                'goals' => json_encode([
                    'Mantener horario de sueño consistente (7-9 horas)',
                    'Crear una rutina relajante para la hora de dormir',
                    'Evitar pantallas 1 hora antes de dormir',
                    'Mantener el dormitorio fresco y oscuro',
                    'Practicar técnicas de relajación antes de dormir'
                ]),
                'duration_days' => 28,
                'points_reward' => 220,
                'badge_rewards' => json_encode(['Maestro del Sueño']),
                'is_active' => true,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addMonths(6),
                'locale' => 'es',
            ],
            [
                'title' => 'Desafío de Vida Sostenible',
                'description' => 'Adopta prácticas ecológicas que beneficien tanto tu salud como el medio ambiente. Haz que las elecciones sostenibles sean parte de tu rutina diaria.',
                'category' => 'environmental',
                'difficulty' => 'intermediate',
                'goals' => json_encode([
                    'Usar bolsas reutilizables para todas las compras',
                    'Reducir plásticos de un solo uso en un 80%',
                    'Comenzar a compostar residuos orgánicos',
                    'Elegir alimentos locales y orgánicos cuando sea posible',
                    'Caminar o ir en bicicleta para viajes menores a 2 millas'
                ]),
                'duration_days' => 30,
                'points_reward' => 250,
                'badge_rewards' => json_encode(['Guerrero Ecológico']),
                'is_active' => true,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addMonths(6),
                'locale' => 'es',
            ],
            [
                'title' => 'Jornada de Construcción de Fuerza',
                'description' => 'Construye fuerza funcional y mejora tu condición física a través del entrenamiento de resistencia progresivo.',
                'category' => 'fitness',
                'difficulty' => 'intermediate',
                'goals' => json_encode([
                    'Completar 3 sesiones de entrenamiento de fuerza por semana',
                    'Dominar 5 ejercicios de peso corporal',
                    'Aumentar la intensidad del entrenamiento gradualmente',
                    'Rastrear progreso y mejoras',
                    'Enfocarse en la forma y técnica adecuadas'
                ]),
                'duration_days' => 42,
                'points_reward' => 300,
                'badge_rewards' => json_encode(['Campeón de Fuerza']),
                'is_active' => true,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addMonths(6),
                'locale' => 'es',
            ],
            [
                'title' => 'Desafío de Nutrición Consciente',
                'description' => 'Desarrolla una relación más saludable con la comida a través de prácticas de alimentación consciente y conciencia nutricional.',
                'category' => 'nutrition',
                'difficulty' => 'beginner',
                'goals' => json_encode([
                    'Comer 5 porciones de frutas y verduras diariamente',
                    'Practicar alimentación consciente en todas las comidas',
                    'Preparar 4 comidas caseras por semana',
                    'Leer etiquetas nutricionales antes de comprar',
                    'Mantener un diario de alimentos por 2 semanas'
                ]),
                'duration_days' => 21,
                'points_reward' => 190,
                'badge_rewards' => json_encode(['Experto en Nutrición']),
                'is_active' => true,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addMonths(6),
                'locale' => 'es',
            ],
            [
                'title' => 'Impulso de Conexión Social',
                'description' => 'Fortalece tus vínculos sociales y bienestar mental priorizando conexiones significativas con otros.',
                'category' => 'mental',
                'difficulty' => 'beginner',
                'goals' => json_encode([
                    'Tener una conversación significativa diariamente',
                    'Contactar a un viejo amigo cada semana',
                    'Participar en una actividad comunitaria',
                    'Practicar habilidades de escucha activa',
                    'Expresar gratitud a alguien diariamente'
                ]),
                'duration_days' => 14,
                'points_reward' => 160,
                'badge_rewards' => json_encode(['Conector Social']),
                'is_active' => true,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addMonths(6),
                'locale' => 'es',
            ],
            [
                'title' => 'Desafío de Optimización de Energía',
                'description' => 'Maximiza tus niveles de energía diarios a través de cambios estratégicos en el estilo de vida y hábitos saludables.',
                'category' => 'fitness',
                'difficulty' => 'advanced',
                'goals' => json_encode([
                    'Mantener horarios de comida consistentes',
                    'Tomar descansos energéticos de 10 minutos cada 2 horas',
                    'Practicar ejercicios de respiración profunda 3 veces al día',
                    'Optimizar la ergonomía del espacio de trabajo',
                    'Rastrear niveles de energía e identificar patrones'
                ]),
                'duration_days' => 35,
                'points_reward' => 280,
                'badge_rewards' => json_encode(['Maestro de la Energía']),
                'is_active' => true,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addMonths(6),
                'locale' => 'es',
            ],
        ];

        foreach ($challenges as $challenge) {
            Challenge::create($challenge);
        }
    }
}
