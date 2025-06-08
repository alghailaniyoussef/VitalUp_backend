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

        // VitalUp Professional Badge Collection
        $badges = [
            // Wellness Journey Badges
            [
                'name' => 'Wellness Warrior',
                'description' => 'Complete your first wellness challenge and start your VitalUp journey',
                'icon_path' => 'shield-check',
                'type' => 'challenge',
                'requirements' => json_encode(['challenge_count' => 1]),
                'points_reward' => 50,
                'is_active' => true,
                'locale' => 'en',
            ],
            [
                'name' => 'Mindful Master',
                'description' => 'Complete 5 mental wellness challenges and achieve inner balance',
                'icon_path' => 'brain',
                'type' => 'challenge',
                'requirements' => json_encode(['specific_challenges' => [3, 4], 'challenge_count' => 5]),
                'points_reward' => 150,
                'is_active' => true,
                'locale' => 'en',
            ],
            [
                'name' => 'Eco Champion',
                'description' => 'Complete all environmental wellness challenges and protect our planet',
                'icon_path' => 'leaf',
                'type' => 'challenge',
                'requirements' => json_encode(['specific_challenges' => [1, 2]]),
                'points_reward' => 120,
                'is_active' => true,
                'locale' => 'en',
            ],
            [
                'name' => 'Social Connector',
                'description' => 'Complete social wellness challenges and build meaningful connections',
                'icon_path' => 'users',
                'type' => 'challenge',
                'requirements' => json_encode(['specific_challenges' => [5, 6]]),
                'points_reward' => 100,
                'is_active' => true,
                'locale' => 'en',
            ],

            // Knowledge & Learning Badges
            [
                'name' => 'Quick Learner',
                'description' => 'Complete your first VitalUp quiz and start building knowledge',
                'icon_path' => 'graduation-cap',
                'type' => 'quiz',
                'requirements' => json_encode(['quiz_count' => 1, 'min_score' => 50]),
                'points_reward' => 25,
                'is_active' => true,
            ],
            [
                'name' => 'Knowledge Seeker',
                'description' => 'Complete 10 quizzes with good scores and expand your wellness knowledge',
                'icon_path' => 'book-open',
                'type' => 'quiz',
                'requirements' => json_encode(['quiz_count' => 10, 'min_score' => 70]),
                'points_reward' => 200,
                'is_active' => true,
                'locale' => 'en',
            ],
            [
                'name' => 'Perfect Scholar',
                'description' => 'Achieve a perfect score on any VitalUp quiz',
                'icon_path' => 'star',
                'type' => 'quiz',
                'requirements' => json_encode(['min_score' => 100, 'quiz_count' => 1]),
                'points_reward' => 100,
                'is_active' => true,
                'locale' => 'en',
            ],
            [
                'name' => 'Wellness Expert',
                'description' => 'Complete 25 quizzes and become a true wellness expert',
                'icon_path' => 'award',
                'type' => 'quiz',
                'requirements' => json_encode(['quiz_count' => 25, 'min_score' => 60]),
                'points_reward' => 500,
                'is_active' => true,
                'locale' => 'en',
            ],

            // Achievement & Progress Badges
            [
                'name' => 'Rising Star',
                'description' => 'Reach level 5 in your VitalUp wellness journey',
                'icon_path' => 'trending-up',
                'type' => 'level',
                'requirements' => json_encode(['level_required' => 5]),
                'points_reward' => 150,
                'is_active' => true,
                'locale' => 'en',
            ],
            [
                'name' => 'Wellness Elite',
                'description' => 'Reach level 10 and join the VitalUp elite community',
                'icon_path' => 'crown',
                'type' => 'level',
                'requirements' => json_encode(['level_required' => 10]),
                'points_reward' => 300,
                'is_active' => true,
                'locale' => 'en',
            ],
            [
                'name' => 'Point Collector',
                'description' => 'Earn your first 500 VitalUp points',
                'icon_path' => 'coins',
                'type' => 'points',
                'requirements' => json_encode(['points_required' => 500]),
                'points_reward' => 75,
                'is_active' => true,
            ],
            [
                'name' => 'Point Master',
                'description' => 'Accumulate 2000 VitalUp points and master the system',
                'icon_path' => 'gem',
                'type' => 'points',
                'requirements' => json_encode(['points_required' => 2000]),
                'points_reward' => 250,
                'is_active' => true,
            ],

            // Special Achievement Badges
            [
                'name' => 'Early Adopter',
                'description' => 'Join VitalUp in its early days and be part of the founding community',
                'icon_path' => 'rocket',
                'type' => 'points',
                'requirements' => json_encode(['special' => 'early_adopter']),
                'points_reward' => 200,
                'is_active' => true,
                'locale' => 'en',
            ],
            [
                'name' => 'Consistency Champion',
                'description' => 'Complete activities for 30 consecutive days',
                'icon_path' => 'calendar-check',
                'type' => 'challenge',
                'requirements' => json_encode(['consecutive_days' => 30]),
                'points_reward' => 400,
                'is_active' => true,
            ],
            [
                'name' => 'VitalUp Ambassador',
                'description' => 'Complete all available challenges and become a VitalUp ambassador',
                'icon_path' => 'megaphone',
                'type' => 'challenge',
                'requirements' => json_encode(['all_challenges' => true]),
                'points_reward' => 1000,
                'is_active' => true,
                'locale' => 'en',
            ],
        ];

        foreach ($badges as $badge) {
            Badge::create($badge);
        }
    }
}
