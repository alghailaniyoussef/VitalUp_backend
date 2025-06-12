<?php

namespace Database\Seeders;

use App\Models\Challenge;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ChallengeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key checks and clear existing challenges
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Challenge::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // VitalUp Professional Wellness Challenges - English
        $challenges = [
            [
                'title' => 'Mindful Morning Routine',
                'description' => 'Establish a consistent morning routine that sets a positive tone for your entire day. Focus on mindfulness, movement, and mental preparation.',
                'category' => 'mental',
                'difficulty' => 'beginner',
                'goals' => json_encode([
                    'Wake up 30 minutes earlier each day',
                    'Practice 10 minutes of meditation or deep breathing',
                    'Write 3 things you\'re grateful for',
                    'Do 5 minutes of light stretching',
                    'Set daily intentions and priorities'
                ]),
                'duration_days' => 21,
                'points_reward' => 180,
                'badge_rewards' => json_encode(['Morning Master']),
                'is_active' => true,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addMonths(6),
                'locale' => 'en',
            ],
            [
                'title' => 'Hydration Hero Challenge',
                'description' => 'Transform your health by maintaining optimal hydration levels throughout the day. Track your water intake and develop healthy drinking habits.',
                'category' => 'nutrition',
                'difficulty' => 'beginner',
                'goals' => json_encode([
                    'Drink 8 glasses of water daily',
                    'Start each day with a glass of water',
                    'Replace one sugary drink with water daily',
                    'Use a reusable water bottle consistently',
                    'Track hydration levels for 2 weeks'
                ]),
                'duration_days' => 14,
                'points_reward' => 150,
                'badge_rewards' => json_encode(['Hydration Hero']),
                'is_active' => true,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addMonths(6),
                'locale' => 'en',
            ],
            [
                'title' => 'Digital Detox Weekend',
                'description' => 'Reclaim your mental space and improve focus by reducing screen time and digital distractions during weekends.',
                'category' => 'mental',
                'difficulty' => 'intermediate',
                'goals' => json_encode([
                    'No social media for 48 hours',
                    'Turn off non-essential notifications',
                    'Engage in offline activities for 4+ hours daily',
                    'Practice mindful eating without screens',
                    'Read a physical book for 1 hour'
                ]),
                'duration_days' => 7,
                'points_reward' => 200,
                'badge_rewards' => json_encode(['Digital Detox Champion']),
                'is_active' => true,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addMonths(6),
                'locale' => 'en',
            ],
            [
                'title' => 'Active Commute Challenge',
                'description' => 'Incorporate more physical activity into your daily routine by choosing active transportation methods.',
                'category' => 'fitness',
                'difficulty' => 'beginner',
                'goals' => json_encode([
                    'Walk or bike to work 3 times per week',
                    'Take stairs instead of elevators',
                    'Park farther away to increase walking',
                    'Get off public transport one stop early',
                    'Track daily steps and aim for 8,000+'
                ]),
                'duration_days' => 21,
                'points_reward' => 170,
                'badge_rewards' => json_encode(['Active Commuter']),
                'is_active' => true,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addMonths(6),
                'locale' => 'en',
            ],
            [
                'title' => 'Stress-Free Sleep Optimization',
                'description' => 'Improve your sleep quality and establish healthy bedtime routines for better rest and recovery.',
                'category' => 'sleep',
                'difficulty' => 'intermediate',
                'goals' => json_encode([
                    'Maintain consistent sleep schedule (7-9 hours)',
                    'Create a relaxing bedtime routine',
                    'Avoid screens 1 hour before bed',
                    'Keep bedroom cool and dark',
                    'Practice relaxation techniques before sleep'
                ]),
                'duration_days' => 28,
                'points_reward' => 220,
                'badge_rewards' => json_encode(['Sleep Master']),
                'is_active' => true,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addMonths(6),
                'locale' => 'en',
            ],
            [
                'title' => 'Sustainable Living Challenge',
                'description' => 'Adopt eco-friendly practices that benefit both your health and the environment. Make sustainable choices part of your daily routine.',
                'category' => 'environmental',
                'difficulty' => 'intermediate',
                'goals' => json_encode([
                    'Use reusable bags for all shopping',
                    'Reduce single-use plastics by 80%',
                    'Start composting organic waste',
                    'Choose local and organic foods when possible',
                    'Walk or bike for trips under 2 miles'
                ]),
                'duration_days' => 30,
                'points_reward' => 250,
                'badge_rewards' => json_encode(['Eco Warrior']),
                'is_active' => true,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addMonths(6),
                'locale' => 'en',
            ],
            [
                'title' => 'Strength Building Journey',
                'description' => 'Build functional strength and improve your physical fitness through progressive resistance training.',
                'category' => 'fitness',
                'difficulty' => 'intermediate',
                'goals' => json_encode([
                    'Complete 3 strength training sessions per week',
                    'Master 5 bodyweight exercises',
                    'Increase workout intensity gradually',
                    'Track progress and improvements',
                    'Focus on proper form and technique'
                ]),
                'duration_days' => 42,
                'points_reward' => 300,
                'badge_rewards' => json_encode(['Strength Champion']),
                'is_active' => true,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addMonths(6),
                'locale' => 'en',
            ],
            [
                'title' => 'Mindful Nutrition Challenge',
                'description' => 'Develop a healthier relationship with food through mindful eating practices and nutritional awareness.',
                'category' => 'nutrition',
                'difficulty' => 'beginner',
                'goals' => json_encode([
                    'Eat 5 servings of fruits and vegetables daily',
                    'Practice mindful eating for all meals',
                    'Prepare 4 home-cooked meals per week',
                    'Read nutrition labels before purchasing',
                    'Keep a food diary for 2 weeks'
                ]),
                'duration_days' => 21,
                'points_reward' => 190,
                'badge_rewards' => json_encode(['Nutrition Expert']),
                'is_active' => true,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addMonths(6),
                'locale' => 'en',
            ],
            [
                'title' => 'Social Connection Boost',
                'description' => 'Strengthen your social bonds and mental well-being by prioritizing meaningful connections with others.',
                'category' => 'mental',
                'difficulty' => 'beginner',
                'goals' => json_encode([
                    'Have one meaningful conversation daily',
                    'Reach out to an old friend each week',
                    'Participate in a community activity',
                    'Practice active listening skills',
                    'Express gratitude to someone daily'
                ]),
                'duration_days' => 14,
                'points_reward' => 160,
                'badge_rewards' => json_encode(['Social Connector']),
                'is_active' => true,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addMonths(6),
                'locale' => 'en',
            ],
            [
                'title' => 'Energy Optimization Challenge',
                'description' => 'Maximize your daily energy levels through strategic lifestyle changes and healthy habits.',
                'category' => 'fitness',
                'difficulty' => 'advanced',
                'goals' => json_encode([
                    'Maintain consistent meal timing',
                    'Take 10-minute energy breaks every 2 hours',
                    'Practice deep breathing exercises 3x daily',
                    'Optimize workspace ergonomics',
                    'Track energy levels and identify patterns'
                ]),
                'duration_days' => 35,
                'points_reward' => 280,
                'badge_rewards' => json_encode(['Energy Master']),
                'is_active' => true,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addMonths(6),
                'locale' => 'en',
            ],
        ];

        foreach ($challenges as $challenge) {
            Challenge::create($challenge);
        }
    }
}
