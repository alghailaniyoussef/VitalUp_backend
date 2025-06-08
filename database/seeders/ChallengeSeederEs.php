<?php

namespace Database\Seeders;

use App\Models\Challenge;
use Illuminate\Database\Seeder;

class ChallengeSeederEs extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Spanish challenges
        $challenges = [
            // Environmental Wellness Challenges
            [
                'title' => 'Día sin Plástico',
                'description' => 'Evita usar plásticos de un solo uso durante un día completo. Lleva contigo bolsas reutilizables, botellas de agua y utensilios.',
                'category' => 'environmental',
                'difficulty' => 'beginner',
                'goals' => ['Reducir el uso de plásticos de un solo uso'],
                'duration_days' => 1,
                'points_reward' => 50,
                'badge_rewards' => [3],
                'is_active' => true,
                'locale' => 'es',
            ],
            [
                'title' => 'Limpieza Comunitaria',
                'description' => 'Organiza o participa en una limpieza comunitaria en tu vecindario, parque local o playa. Recoge basura y separa los reciclables.',
                'category' => 'environmental',
                'difficulty' => 'intermediate',
                'goals' => ['Contribuir a un entorno más limpio'],
                'duration_days' => 1,
                'points_reward' => 100,
                'badge_rewards' => [3],
                'is_active' => true,
                'locale' => 'es',
            ],

            // Mental Wellness Challenges
            [
                'title' => 'Diario de Gratitud',
                'description' => 'Escribe tres cosas por las que estés agradecido cada día durante una semana. Reflexiona sobre por qué estas cosas son importantes para ti.',
                'category' => 'mental',
                'difficulty' => 'beginner',
                'goals' => ['Cultivar una mentalidad de gratitud'],
                'duration_days' => 7,
                'points_reward' => 75,
                'badge_rewards' => [2],
                'is_active' => true,
                'locale' => 'es',
            ],
            [
                'title' => 'Meditación Diaria',
                'description' => 'Practica la meditación durante 10 minutos cada día durante 5 días. Concéntrate en tu respiración y observa tus pensamientos sin juzgarlos.',
                'category' => 'mental',
                'difficulty' => 'intermediate',
                'goals' => ['Reducir el estrés y mejorar la atención plena'],
                'duration_days' => 5,
                'points_reward' => 100,
                'badge_rewards' => [2],
                'is_active' => true,
                'locale' => 'es',
            ],

            // Social Wellness Challenges
            [
                'title' => 'Acto de Bondad Aleatorio',
                'description' => 'Realiza un acto de bondad aleatorio para un extraño, amigo o familiar. Podría ser tan simple como dar un cumplido sincero o ayudar con una tarea.',
                'category' => 'social',
                'difficulty' => 'beginner',
                'goals' => ['Difundir positividad y fortalecer conexiones'],
                'duration_days' => 1,
                'points_reward' => 50,
                'badge_rewards' => [4],
                'is_active' => true,
                'locale' => 'es',
            ],
            [
                'title' => 'Día de Desconexión Digital',
                'description' => 'Pasa un día entero sin redes sociales ni entretenimiento digital. En su lugar, conecta con amigos o familiares en persona o por teléfono.',
                'category' => 'social',
                'difficulty' => 'advanced',
                'goals' => ['Mejorar las conexiones del mundo real'],
                'duration_days' => 1,
                'points_reward' => 150,
                'badge_rewards' => [4],
                'is_active' => true,
                'locale' => 'es',
            ],

            // Physical Wellness Challenges
            [
                'title' => '10,000 Pasos Diarios',
                'description' => 'Camina al menos 10,000 pasos cada día durante una semana. Usa un rastreador de fitness o una aplicación de teléfono para contar tus pasos.',
                'category' => 'physical',
                'difficulty' => 'intermediate',
                'goals' => ['Aumentar la actividad física diaria'],
                'duration_days' => 7,
                'points_reward' => 125,
                'badge_rewards' => null,
                'is_active' => true,
                'locale' => 'es',
            ],
            [
                'title' => 'Hidratación Adecuada',
                'description' => 'Bebe al menos 8 vasos de agua cada día durante 3 días. Lleva un registro de tu consumo de agua y observa cómo te sientes.',
                'category' => 'physical',
                'difficulty' => 'beginner',
                'goals' => ['Mejorar la hidratación y la salud general'],
                'duration_days' => 3,
                'points_reward' => 75,
                'badge_rewards' => null,
                'is_active' => true,
                'locale' => 'es',
            ],

            // Financial Wellness Challenges
            [
                'title' => 'Seguimiento de Gastos',
                'description' => 'Registra todos tus gastos durante una semana. Categoriza cada gasto y reflexiona sobre tus hábitos de gasto.',
                'category' => 'wellness',
                'difficulty' => 'intermediate',
                'goals' => ['Aumentar la conciencia financiera'],
                'duration_days' => 7,
                'points_reward' => 100,
                'badge_rewards' => null,
                'is_active' => true,
                'locale' => 'es',
            ],
            [
                'title' => 'Día sin Gastos',
                'description' => 'Pasa un día entero sin gastar dinero. Planifica con anticipación y utiliza lo que ya tienes.',
                'category' => 'wellness',
                'difficulty' => 'advanced',
                'goals' => ['Practicar la frugalidad y la contención'],
                'duration_days' => 3,
                'points_reward' => 75,
                'badge_rewards' => null,
                'is_active' => true,
                'locale' => 'es',
            ],

            // Intellectual Wellness Challenges
            [
                'title' => 'Lectura Diaria',
                'description' => 'Lee al menos 20 páginas de un libro cada día durante 5 días. Elige un libro que amplíe tus conocimientos o perspectivas.',
                'category' => 'mental',
                'difficulty' => 'intermediate',
                'goals' => ['Estimular la mente y ampliar conocimientos'],
                'duration_days' => 1,
                'points_reward' => 100,
                'badge_rewards' => null,
                'is_active' => true,
                'locale' => 'es',
            ],
            [
                'title' => 'Aprender una Nueva Habilidad',
                'description' => 'Dedica tiempo a aprender una nueva habilidad o hobby. Podría ser cocinar una nueva receta, aprender algunas frases en un idioma extranjero, o probar una manualidad.',
                'category' => 'mental',
                'difficulty' => 'intermediate',
                'goals' => ['Expandir capacidades y estimular la creatividad'],
                'duration_days' => 1,
                'points_reward' => 100,
                'badge_rewards' => null,
                'is_active' => true,
                'locale' => 'es',
            ],
        ];

        foreach ($challenges as $challenge) {
            Challenge::create($challenge);
        }
    }
}
