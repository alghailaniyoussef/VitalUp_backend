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
        // Spanish badges - 15 badges matching English versions
        $badges = [
            [
                'name' => 'Trofeo de Campeón',
                'description' => 'Completa tu primer desafío de bienestar y gana el trofeo de campeón',
                'icon_path' => 'trophy',
                'type' => 'challenge',
                'requirements' => json_encode(['challenge_count' => 1]),
                'points_reward' => 50,
                'is_active' => true,
                'locale' => 'es',
            ],
            [
                'name' => 'Medalla de Honor',
                'description' => 'Completa 5 desafíos y recibe la medalla de honor',
                'icon_path' => 'medal',
                'type' => 'challenge',
                'requirements' => json_encode(['challenge_count' => 5]),
                'points_reward' => 150,
                'is_active' => true,
                'locale' => 'es',
            ],
            [
                'name' => 'Estrella Ascendente',
                'description' => 'Logra una puntuación perfecta en cualquier cuestionario de VitalUp',
                'icon_path' => 'star',
                'type' => 'quiz',
                'requirements' => json_encode(['min_score' => 100, 'quiz_count' => 1]),
                'points_reward' => 100,
                'is_active' => true,
                'locale' => 'es',
            ],
            [
                'name' => 'Corona del Bienestar',
                'description' => 'Alcanza el nivel 10 y únete a la comunidad élite de VitalUp',
                'icon_path' => 'crown',
                'type' => 'level',
                'requirements' => json_encode(['level_required' => 10]),
                'points_reward' => 300,
                'is_active' => true,
                'locale' => 'es',
            ],
            [
                'name' => 'Espíritu de Fuego',
                'description' => 'Completa actividades durante 30 días consecutivos',
                'icon_path' => 'fire',
                'type' => 'challenge',
                'requirements' => json_encode(['consecutive_days' => 30]),
                'points_reward' => 400,
                'is_active' => true,
                'locale' => 'es',
            ],
            [
                'name' => 'Rayo Veloz',
                'description' => 'Completa 3 cuestionarios en menos de 5 minutos cada uno',
                'icon_path' => 'lightning',
                'type' => 'quiz',
                'requirements' => json_encode(['quick_completion' => 3]),
                'points_reward' => 200,
                'is_active' => true,
                'locale' => 'es',
            ],
            [
                'name' => 'Logro de Diamante',
                'description' => 'Acumula 2000 puntos de VitalUp y domina el sistema',
                'icon_path' => 'diamond',
                'type' => 'points',
                'requirements' => json_encode(['points_required' => 2000]),
                'points_reward' => 250,
                'is_active' => true,
                'locale' => 'es',
            ],
            [
                'name' => 'Escudo Guardián',
                'description' => 'Completa todos los desafíos de bienestar ambiental',
                'icon_path' => 'shield',
                'type' => 'challenge',
                'requirements' => json_encode(['specific_challenges' => [1, 2]]),
                'points_reward' => 120,
                'is_active' => true,
                'locale' => 'es',
            ],
            [
                'name' => 'Objetivo Perfecto',
                'description' => 'Logra 90% o más en 10 cuestionarios',
                'icon_path' => 'target',
                'type' => 'quiz',
                'requirements' => json_encode(['quiz_count' => 10, 'min_score' => 90]),
                'points_reward' => 300,
                'is_active' => true,
                'locale' => 'es',
            ],
            [
                'name' => 'Lanzador de Cohetes',
                'description' => 'Únete a VitalUp en sus primeros días y sé parte de la comunidad fundadora',
                'icon_path' => 'rocket',
                'type' => 'special',
                'requirements' => json_encode(['special' => 'early_adopter']),
                'points_reward' => 200,
                'is_active' => true,
                'locale' => 'es',
            ],
            [
                'name' => 'Poder Cerebral',
                'description' => 'Completa 5 desafíos de bienestar mental y logra el equilibrio interior',
                'icon_path' => 'brain',
                'type' => 'challenge',
                'requirements' => json_encode(['specific_challenges' => [3, 4], 'challenge_count' => 5]),
                'points_reward' => 150,
                'is_active' => true,
                'locale' => 'es',
            ],
            [
                'name' => 'Corazón de Oro',
                'description' => 'Completa desafíos de bienestar social y construye conexiones significativas',
                'icon_path' => 'heart',
                'type' => 'challenge',
                'requirements' => json_encode(['specific_challenges' => [5, 6]]),
                'points_reward' => 100,
                'is_active' => true,
                'locale' => 'es',
            ],
            [
                'name' => 'Constructor de Músculos',
                'description' => 'Completa 15 desafíos de bienestar físico',
                'icon_path' => 'muscle',
                'type' => 'challenge',
                'requirements' => json_encode(['physical_challenges' => 15]),
                'points_reward' => 350,
                'is_active' => true,
                'locale' => 'es',
            ],
            [
                'name' => 'Libro del Conocimiento',
                'description' => 'Completa 25 cuestionarios y conviértete en un verdadero experto en bienestar',
                'icon_path' => 'book',
                'type' => 'quiz',
                'requirements' => json_encode(['quiz_count' => 25, 'min_score' => 60]),
                'points_reward' => 500,
                'is_active' => true,
                'locale' => 'es',
            ],
            [
                'name' => 'Maestro de Graduación',
                'description' => 'Completa tu primer cuestionario de VitalUp y comienza a construir conocimiento',
                'icon_path' => 'graduation',
                'type' => 'quiz',
                'requirements' => json_encode(['quiz_count' => 1, 'min_score' => 50]),
                'points_reward' => 25,
                'is_active' => true,
                'locale' => 'es',
            ],
        ];

        foreach ($badges as $badge) {
            Badge::create($badge);
        }
    }
}
