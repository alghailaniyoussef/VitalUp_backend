<?php

namespace Database\Seeders;

use App\Models\Badge;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BadgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key checks and clear existing badges
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Badge::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // VitalUp Professional Badge Collection - 15 English Badges
        $badges = [
            [
                'name' => 'Champion Trophy',
                'description' => 'Complete your first wellness challenge and earn the champion trophy',
                'icon_path' => 'trophy',
                'type' => 'challenge',
                'requirements' => json_encode(['challenge_count' => 1]),
                'points_reward' => 50,
                'is_active' => true,
                'locale' => 'en',
            ],
            [
                'name' => 'Honor Medal',
                'description' => 'Complete 5 challenges and receive the honor medal',
                'icon_path' => 'medal',
                'type' => 'challenge',
                'requirements' => json_encode(['challenge_count' => 5]),
                'points_reward' => 150,
                'is_active' => true,
                'locale' => 'en',
            ],
            [
                'name' => 'Rising Star',
                'description' => 'Achieve a perfect score on any VitalUp quiz',
                'icon_path' => 'star',
                'type' => 'quiz',
                'requirements' => json_encode(['min_score' => 100, 'quiz_count' => 1]),
                'points_reward' => 100,
                'is_active' => true,
                'locale' => 'en',
            ],
            [
                'name' => 'Wellness Crown',
                'description' => 'Reach level 10 and join the VitalUp elite community',
                'icon_path' => 'crown',
                'type' => 'level',
                'requirements' => json_encode(['level_required' => 10]),
                'points_reward' => 300,
                'is_active' => true,
                'locale' => 'en',
            ],
            [
                'name' => 'Fire Spirit',
                'description' => 'Complete activities for 30 consecutive days',
                'icon_path' => 'fire',
                'type' => 'challenge',
                'requirements' => json_encode(['consecutive_days' => 30]),
                'points_reward' => 400,
                'is_active' => true,
                'locale' => 'en',
            ],
            [
                'name' => 'Lightning Fast',
                'description' => 'Complete 3 quizzes in under 5 minutes each',
                'icon_path' => 'lightning',
                'type' => 'quiz',
                'requirements' => json_encode(['quick_completion' => 3]),
                'points_reward' => 200,
                'is_active' => true,
                'locale' => 'en',
            ],
            [
                'name' => 'Diamond Achievement',
                'description' => 'Accumulate 2000 VitalUp points and master the system',
                'icon_path' => 'diamond',
                'type' => 'points',
                'requirements' => json_encode(['points_required' => 2000]),
                'points_reward' => 250,
                'is_active' => true,
                'locale' => 'en',
            ],
            [
                'name' => 'Guardian Shield',
                'description' => 'Complete all environmental wellness challenges',
                'icon_path' => 'shield',
                'type' => 'challenge',
                'requirements' => json_encode(['specific_challenges' => [1, 2]]),
                'points_reward' => 120,
                'is_active' => true,
                'locale' => 'en',
            ],
            [
                'name' => 'Perfect Target',
                'description' => 'Achieve 90% or higher on 10 quizzes',
                'icon_path' => 'target',
                'type' => 'quiz',
                'requirements' => json_encode(['quiz_count' => 10, 'min_score' => 90]),
                'points_reward' => 300,
                'is_active' => true,
                'locale' => 'en',
            ],
            [
                'name' => 'Rocket Launcher',
                'description' => 'Join VitalUp in its early days and be part of the founding community',
                'icon_path' => 'rocket',
                'type' => 'special',
                'requirements' => json_encode(['special' => 'early_adopter']),
                'points_reward' => 200,
                'is_active' => true,
                'locale' => 'en',
            ],
            [
                'name' => 'Brain Power',
                'description' => 'Complete 5 mental wellness challenges and achieve inner balance',
                'icon_path' => 'brain',
                'type' => 'challenge',
                'requirements' => json_encode(['specific_challenges' => [3, 4], 'challenge_count' => 5]),
                'points_reward' => 150,
                'is_active' => true,
                'locale' => 'en',
            ],
            [
                'name' => 'Heart of Gold',
                'description' => 'Complete social wellness challenges and build meaningful connections',
                'icon_path' => 'heart',
                'type' => 'challenge',
                'requirements' => json_encode(['specific_challenges' => [5, 6]]),
                'points_reward' => 100,
                'is_active' => true,
                'locale' => 'en',
            ],
            [
                'name' => 'Muscle Builder',
                'description' => 'Complete 15 physical wellness challenges',
                'icon_path' => 'muscle',
                'type' => 'challenge',
                'requirements' => json_encode(['physical_challenges' => 15]),
                'points_reward' => 350,
                'is_active' => true,
                'locale' => 'en',
            ],
            [
                'name' => 'Knowledge Book',
                'description' => 'Complete 25 quizzes and become a true wellness expert',
                'icon_path' => 'book',
                'type' => 'quiz',
                'requirements' => json_encode(['quiz_count' => 25, 'min_score' => 60]),
                'points_reward' => 500,
                'is_active' => true,
                'locale' => 'en',
            ],
            [
                'name' => 'Graduation Master',
                'description' => 'Complete your first VitalUp quiz and start building knowledge',
                'icon_path' => 'graduation',
                'type' => 'quiz',
                'requirements' => json_encode(['quiz_count' => 1, 'min_score' => 50]),
                'points_reward' => 25,
                'is_active' => true,
                'locale' => 'en',
            ],
        ];

        foreach ($badges as $badge) {
            Badge::create($badge);
        }
    }
}
