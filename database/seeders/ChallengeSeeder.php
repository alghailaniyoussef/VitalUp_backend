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

        // VitalUp Professional Wellness Challenges
        $challenges = [
            // Environmental Wellness Challenges
            [
                'title' => 'Green Living Challenge',
                'description' => 'Adopt eco-friendly habits for a sustainable lifestyle. Reduce your carbon footprint through daily green choices.',
                'category' => 'environmental',
                'difficulty' => 'beginner',
                'goals' => json_encode([
                    'Use reusable water bottles for 7 days',
                    'Walk or bike instead of driving for short trips',
                    'Reduce plastic usage by 50%',
                    'Start composting organic waste',
                    'Switch to energy-efficient LED bulbs'
                ]),
                'duration_days' => 14,
                'points_reward' => 150,
                'badge_rewards' => json_encode(['Eco Champion']),
                'is_active' => true,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addMonths(6),
                'locale' => 'en',
            ],
            [
                'title' => 'Zero Waste Week',
                'description' => 'Challenge yourself to produce minimal waste for one week. Learn sustainable practices that benefit our planet.',
                'category' => 'environmental',
                'difficulty' => 'intermediate',
                'goals' => json_encode([
                    'Eliminate single-use plastics',
                    'Repurpose household items creatively',
                    'Buy only package-free products',
                    'Donate unused items instead of throwing away',
                    'Track and minimize daily waste production'
                ]),
                'duration_days' => 7,
                'points_reward' => 200,
                'badge_rewards' => json_encode(['Eco Champion', 'Wellness Warrior']),
                'is_active' => true,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addMonths(6),
                'locale' => 'en',
            ],

            // Mental Wellness Challenges
            [
                'title' => 'Mindfulness Mastery',
                'description' => 'Develop a consistent mindfulness practice to reduce stress and improve mental clarity.',
                'category' => 'mental',
                'difficulty' => 'beginner',
                'goals' => json_encode([
                    'Practice 10 minutes of daily meditation',
                    'Keep a gratitude journal for 2 weeks',
                    'Try 3 different breathing exercises',
                    'Practice mindful eating for one week',
                    'Complete a digital detox for 24 hours'
                ]),
                'duration_days' => 21,
                'points_reward' => 180,
                'badge_rewards' => json_encode(['Mindful Master']),
                'is_active' => true,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addMonths(6),
                'locale' => 'en',
            ],
            [
                'title' => 'Stress-Free Living',
                'description' => 'Learn effective stress management techniques and create a calmer, more balanced lifestyle.',
                'category' => 'mental',
                'difficulty' => 'intermediate',
                'goals' => json_encode([
                    'Establish a morning routine for mental clarity',
                    'Practice progressive muscle relaxation',
                    'Limit news consumption to reduce anxiety',
                    'Create a peaceful sleep environment',
                    'Learn and practice 5 stress-relief techniques'
                ]),
                'duration_days' => 28,
                'points_reward' => 220,
                'badge_rewards' => json_encode(['Mindful Master', 'Wellness Warrior']),
                'is_active' => true,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addMonths(6),
                'locale' => 'en',
            ],

            // Social Wellness Challenges
            [
                'title' => 'Community Connection',
                'description' => 'Strengthen your social bonds and build meaningful relationships within your community.',
                'category' => 'social',
                'difficulty' => 'beginner',
                'goals' => json_encode([
                    'Volunteer for a local charity or cause',
                    'Organize a community cleanup event',
                    'Connect with 3 new neighbors',
                    'Join a local club or group activity',
                    'Practice random acts of kindness daily'
                ]),
                'duration_days' => 30,
                'points_reward' => 160,
                'badge_rewards' => json_encode(['Social Connector']),
                'is_active' => true,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addMonths(6),
                'locale' => 'en',
            ],
            [
                'title' => 'Digital Wellness Balance',
                'description' => 'Create healthy boundaries with technology while maintaining meaningful digital connections.',
                'category' => 'social',
                'difficulty' => 'intermediate',
                'goals' => json_encode([
                    'Implement phone-free meal times',
                    'Schedule regular video calls with family',
                    'Join an online wellness community',
                    'Practice active listening in conversations',
                    'Create tech-free zones in your home'
                ]),
                'duration_days' => 21,
                'points_reward' => 190,
                'badge_rewards' => json_encode(['Social Connector', 'Mindful Master']),
                'is_active' => true,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addMonths(6),
                'locale' => 'en',
            ],

            // Physical Wellness Challenges
            [
                'title' => 'Active Lifestyle Kickstart',
                'description' => 'Build sustainable exercise habits and improve your physical fitness through enjoyable activities.',
                'category' => 'physical',
                'difficulty' => 'beginner',
                'goals' => json_encode([
                    'Walk 10,000 steps daily for 2 weeks',
                    'Try 3 new forms of exercise',
                    'Stretch for 15 minutes each morning',
                    'Take stairs instead of elevators',
                    'Participate in one outdoor activity weekly'
                ]),
                'duration_days' => 21,
                'points_reward' => 170,
                'badge_rewards' => json_encode(['Wellness Warrior']),
                'is_active' => true,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addMonths(6),
                'locale' => 'en',
            ],
            [
                'title' => 'Nutrition Transformation',
                'description' => 'Develop healthy eating habits and discover the power of nutritious, whole foods.',
                'category' => 'nutrition',
                'difficulty' => 'intermediate',
                'goals' => json_encode([
                    'Eat 5 servings of fruits and vegetables daily',
                    'Prepare 3 healthy meals from scratch weekly',
                    'Reduce processed food consumption by 70%',
                    'Stay hydrated with 8 glasses of water daily',
                    'Try 5 new healthy recipes'
                ]),
                'duration_days' => 28,
                'points_reward' => 200,
                'badge_rewards' => json_encode(['Wellness Warrior']),
                'is_active' => true,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addMonths(6),
                'locale' => 'en',
            ],

            // Holistic Wellness Challenges
            [
                'title' => 'Sleep Optimization Challenge',
                'description' => 'Improve your sleep quality and establish healthy sleep patterns for better overall wellness.',
                'category' => 'sleep',
                'difficulty' => 'beginner',
                'goals' => json_encode([
                    'Maintain consistent sleep schedule for 2 weeks',
                    'Create a relaxing bedtime routine',
                    'Limit screen time 1 hour before bed',
                    'Optimize bedroom environment for sleep',
                    'Track sleep quality and patterns'
                ]),
                'duration_days' => 21,
                'points_reward' => 150,
                'badge_rewards' => json_encode(['Wellness Warrior']),
                'is_active' => true,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addMonths(6),
                'locale' => 'en',
            ],
            [
                'title' => 'VitalUp Lifestyle Mastery',
                'description' => 'The ultimate wellness challenge combining all aspects of healthy living for complete transformation.',
                'category' => 'wellness',
                'difficulty' => 'advanced',
                'goals' => json_encode([
                    'Complete daily wellness activities across all categories',
                    'Maintain consistent healthy habits for 30 days',
                    'Share your wellness journey with the community',
                    'Mentor another VitalUp member',
                    'Achieve personal wellness goals you set'
                ]),
                'duration_days' => 60,
                'points_reward' => 500,
                'badge_rewards' => json_encode(['VitalUp Ambassador', 'Consistency Champion']),
                'is_active' => true,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addMonths(12),
                'locale' => 'en',
            ],
        ];

        foreach ($challenges as $challenge) {
            Challenge::create($challenge);
        }
    }
}
