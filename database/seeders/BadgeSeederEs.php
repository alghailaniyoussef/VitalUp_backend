<?php

namespace Database\Seeders;

use App\Models\Badge;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BadgeSeederEs extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Spanish badges
        $badges = [
            // Wellness Journey Badges
            [
                'name' => 'Guerrero del Bienestar',
                'description' => 'Completa tu primer desafío de bienestar y comienza tu viaje con VitalUp',
                'icon_path' => 'shield-check',
                'type' => 'challenge',
                'requirements' => json_encode(['challenge_count' => 1]),
                'points_reward' => 50,
                'is_active' => true,
                'locale' => 'es',
            ],
            [
                'name' => 'Maestro de la Atención Plena',
                'description' => 'Completa 5 desafíos de bienestar mental y logra el equilibrio interior',
                'icon_path' => 'brain',
                'type' => 'challenge',
                'requirements' => json_encode(['specific_challenges' => [3, 4], 'challenge_count' => 5]),
                'points_reward' => 150,
                'is_active' => true,
                'locale' => 'es',
            ],
            [
                'name' => 'Campeón Ecológico',
                'description' => 'Completa todos los desafíos de bienestar ambiental y protege nuestro planeta',
                'icon_path' => 'leaf',
                'type' => 'challenge',
                'requirements' => json_encode(['specific_challenges' => [1, 2]]),
                'points_reward' => 120,
                'is_active' => true,
                'locale' => 'es',
            ],
            [
                'name' => 'Conector Social',
                'description' => 'Completa desafíos de bienestar social y construye conexiones significativas',
                'icon_path' => 'users',
                'type' => 'challenge',
                'requirements' => json_encode(['specific_challenges' => [5, 6]]),
                'points_reward' => 100,
                'is_active' => true,
                'locale' => 'es',
            ],

            // Knowledge & Learning Badges
            [
                'name' => 'Aprendiz Rápido',
                'description' => 'Completa tu primer cuestionario de VitalUp y comienza a construir conocimiento',
                'icon_path' => 'graduation-cap',
                'type' => 'quiz',
                'requirements' => json_encode(['quiz_count' => 1, 'min_score' => 50]),
                'points_reward' => 25,
                'is_active' => true,
                'locale' => 'es',
            ],
            [
                'name' => 'Buscador de Conocimiento',
                'description' => 'Completa 10 cuestionarios con buenas puntuaciones y amplía tu conocimiento sobre el bienestar',
                'icon_path' => 'book-open',
                'type' => 'quiz',
                'requirements' => json_encode(['quiz_count' => 10, 'min_score' => 70]),
                'points_reward' => 200,
                'is_active' => true,
                'locale' => 'es',
            ],
            [
                'name' => 'Erudito Perfecto',
                'description' => 'Logra una puntuación perfecta en cualquier cuestionario de VitalUp',
                'icon_path' => 'star',
                'type' => 'quiz',
                'requirements' => json_encode(['min_score' => 100, 'quiz_count' => 1]),
                'points_reward' => 100,
                'is_active' => true,
                'locale' => 'es',
            ],
            [
                'name' => 'Experto en Bienestar',
                'description' => 'Completa 25 cuestionarios y conviértete en un verdadero experto en bienestar',
                'icon_path' => 'award',
                'type' => 'quiz',
                'requirements' => json_encode(['quiz_count' => 25, 'min_score' => 60]),
                'points_reward' => 500,
                'is_active' => true,
                'locale' => 'es',
            ],

            // Achievement & Progress Badges
            [
                'name' => 'Estrella Ascendente',
                'description' => 'Alcanza el nivel 5 en tu viaje de bienestar con VitalUp',
                'icon_path' => 'trending-up',
                'type' => 'level',
                'requirements' => json_encode(['level_required' => 5]),
                'points_reward' => 150,
                'is_active' => true,
                'locale' => 'es',
            ],
            [
                'name' => 'Élite del Bienestar',
                'description' => 'Alcanza el nivel 10 y únete a la comunidad élite de VitalUp',
                'icon_path' => 'crown',
                'type' => 'level',
                'requirements' => json_encode(['level_required' => 10]),
                'points_reward' => 300,
                'is_active' => true,
                'locale' => 'es',
            ],
            [
                'name' => 'Coleccionista de Puntos',
                'description' => 'Gana tus primeros 500 puntos de VitalUp',
                'icon_path' => 'coins',
                'type' => 'points',
                'requirements' => json_encode(['points_required' => 500]),
                'points_reward' => 75,
                'is_active' => true,
                'locale' => 'es',
            ],
            [
                'name' => 'Maestro de Puntos',
                'description' => 'Acumula 2000 puntos de VitalUp y domina el sistema',
                'icon_path' => 'gem',
                'type' => 'points',
                'requirements' => json_encode(['points_required' => 2000]),
                'points_reward' => 250,
                'is_active' => true,
                'locale' => 'es',
            ],

            // Special Achievement Badges
            [
                'name' => 'Adoptador Temprano',
                'description' => 'Únete a VitalUp en sus primeros días y sé parte de la comunidad fundadora',
                'icon_path' => 'rocket',
                'type' => 'points',
                'requirements' => json_encode(['special' => 'early_adopter']),
                'points_reward' => 200,
                'is_active' => true,
                'locale' => 'es',
            ],
            [
                'name' => 'Campeón de Consistencia',
                'description' => 'Completa actividades durante 30 días consecutivos',
                'icon_path' => 'calendar-check',
                'type' => 'challenge',
                'requirements' => json_encode(['consecutive_days' => 30]),
                'points_reward' => 400,
                'is_active' => true,
                'locale' => 'es',
            ],
            [
                'name' => 'Embajador de VitalUp',
                'description' => 'Completa todos los desafíos disponibles y conviértete en un embajador de VitalUp',
                'icon_path' => 'megaphone',
                'type' => 'challenge',
                'requirements' => json_encode(['all_challenges' => true]),
                'points_reward' => 1000,
                'is_active' => true,
                'locale' => 'es',
            ],
        ];

        foreach ($badges as $badge) {
            Badge::create($badge);
        }
    }
}
