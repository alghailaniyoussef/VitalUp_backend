<?php

namespace Database\Seeders;

use App\Models\Quiz;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key checks and clear existing quizzes
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Quiz::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // VitalUp Professional Wellness Quizzes - English
        $quizzes = [
            [
                'title' => 'Nutrition Fundamentals',
                'description' => 'Test your knowledge about essential nutrition principles and healthy eating habits for optimal wellness.',
                'questions' => json_encode([
                    [
                        'id' => 1,
                        'text' => 'Which macronutrient is the body\'s primary source of energy?',
                        'options' => ['Proteins', 'Carbohydrates', 'Fats', 'Vitamins'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 2,
                        'text' => 'How many servings of fruits and vegetables should adults consume daily?',
                        'options' => ['3-4 servings', '5-9 servings', '1-2 servings', '10+ servings'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 3,
                        'text' => 'What is the recommended daily water intake for adults?',
                        'options' => ['4-6 glasses', '8-10 glasses', '2-3 glasses', '12+ glasses'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 4,
                        'text' => 'Which nutrient is essential for muscle repair and growth?',
                        'options' => ['Carbohydrates', 'Vitamins', 'Protein', 'Minerals'],
                        'correct_answer' => 2
                    ],
                    [
                        'id' => 5,
                        'text' => 'What percentage of your plate should be filled with vegetables?',
                        'options' => ['25%', '50%', '75%', '10%'],
                        'correct_answer' => 1
                    ]
                ]),
                'points_per_question' => 10,
                'is_active' => true,
                'available_from' => Carbon::now(),
                'available_until' => Carbon::now()->addMonths(12),
                'locale' => 'en',
                'icon_path' => 'trophy'
            ],
            [
                'title' => 'Mental Health Awareness',
                'description' => 'Explore key concepts in mental health and stress management for better psychological well-being.',
                'questions' => json_encode([
                    [
                        'id' => 1,
                        'text' => 'Which practice is most effective for reducing daily stress?',
                        'options' => ['Deep breathing exercises', 'Watching TV', 'Eating comfort food', 'Working longer hours'],
                        'correct_answer' => 0
                    ],
                    [
                        'id' => 2,
                        'text' => 'How many hours of sleep do most adults need per night?',
                        'options' => ['5-6 hours', '7-9 hours', '10-12 hours', '4-5 hours'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 3,
                        'text' => 'What is a healthy way to cope with anxiety?',
                        'options' => ['Avoiding all stressful situations', 'Mindfulness meditation', 'Isolating yourself', 'Ignoring the feelings'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 4,
                        'text' => 'Which activity can improve mental clarity?',
                        'options' => ['Regular exercise', 'Excessive caffeine', 'Skipping meals', 'Staying indoors'],
                        'correct_answer' => 0
                    ],
                    [
                        'id' => 5,
                        'text' => 'What is the benefit of keeping a gratitude journal?',
                        'options' => ['Improves memory', 'Enhances positive thinking', 'Increases appetite', 'Reduces sleep'],
                        'correct_answer' => 1
                    ]
                ]),
                'points_per_question' => 10,
                'is_active' => true,
                'available_from' => Carbon::now(),
                'available_until' => Carbon::now()->addMonths(12),
                'locale' => 'en',
                'icon_path' => 'brain'
            ],
            [
                'title' => 'Fitness Fundamentals',
                'description' => 'Test your understanding of exercise principles and physical fitness for a healthier lifestyle.',
                'questions' => json_encode([
                    [
                        'id' => 1,
                        'text' => 'How many minutes of moderate exercise should adults get per week?',
                        'options' => ['75 minutes', '150 minutes', '300 minutes', '30 minutes'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 2,
                        'text' => 'Which type of exercise is best for cardiovascular health?',
                        'options' => ['Weight lifting only', 'Aerobic exercise', 'Stretching only', 'Yoga only'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 3,
                        'text' => 'When is the best time to stretch?',
                        'options' => ['Only before exercise', 'After warming up', 'Never', 'Only when injured'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 4,
                        'text' => 'What is the recommended rest time between strength training sessions?',
                        'options' => ['No rest needed', '24-48 hours', '1 week', '10 minutes'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 5,
                        'text' => 'Which is a sign of overtraining?',
                        'options' => ['Increased energy', 'Better sleep', 'Persistent fatigue', 'Improved mood'],
                        'correct_answer' => 2
                    ]
                ]),
                'points_per_question' => 10,
                'is_active' => true,
                'available_from' => Carbon::now(),
                'available_until' => Carbon::now()->addMonths(12),
                'locale' => 'en',
                'icon_path' => 'muscle'
            ],
            [
                'title' => 'Sleep Optimization',
                'description' => 'Learn about healthy sleep habits and their impact on overall wellness and daily performance.',
                'questions' => json_encode([
                    [
                        'id' => 1,
                        'text' => 'What is the ideal bedroom temperature for sleep?',
                        'options' => ['75-80°F', '60-67°F', '50-55°F', '80-85°F'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 2,
                        'text' => 'How long before bedtime should you avoid screens?',
                        'options' => ['30 minutes', '1 hour', '3 hours', '5 minutes'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 3,
                        'text' => 'Which beverage should be avoided before bedtime?',
                        'options' => ['Herbal tea', 'Water', 'Coffee', 'Warm milk'],
                        'correct_answer' => 2
                    ],
                    [
                        'id' => 4,
                        'text' => 'What is sleep hygiene?',
                        'options' => ['Showering before bed', 'Practices that promote good sleep', 'Cleaning your bedroom', 'Washing bedsheets'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 5,
                        'text' => 'Which activity can improve sleep quality?',
                        'options' => ['Late-night exercise', 'Regular sleep schedule', 'Large meals before bed', 'Bright lights'],
                        'correct_answer' => 1
                    ]
                ]),
                'points_per_question' => 10,
                'is_active' => true,
                'available_from' => Carbon::now(),
                'available_until' => Carbon::now()->addMonths(12),
                'locale' => 'en',
                'icon_path' => 'star'
            ],
            [
                'title' => 'Stress Management',
                'description' => 'Discover effective strategies for managing stress and maintaining emotional balance in daily life.',
                'questions' => json_encode([
                    [
                        'id' => 1,
                        'text' => 'Which is a physical symptom of chronic stress?',
                        'options' => ['Improved digestion', 'Better sleep', 'Muscle tension', 'Increased energy'],
                        'correct_answer' => 2
                    ],
                    [
                        'id' => 2,
                        'text' => 'What is the 4-7-8 breathing technique?',
                        'options' => ['Inhale 4, hold 7, exhale 8', 'Exercise for 4-7-8 minutes', 'Eat 4-7-8 times daily', 'Sleep 4-7-8 hours'],
                        'correct_answer' => 0
                    ],
                    [
                        'id' => 3,
                        'text' => 'Which activity is NOT recommended for stress relief?',
                        'options' => ['Meditation', 'Exercise', 'Excessive alcohol consumption', 'Deep breathing'],
                        'correct_answer' => 2
                    ],
                    [
                        'id' => 4,
                        'text' => 'What is progressive muscle relaxation?',
                        'options' => ['Running progressively faster', 'Tensing and relaxing muscle groups', 'Lifting heavier weights', 'Stretching for hours'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 5,
                        'text' => 'How can time management help reduce stress?',
                        'options' => ['By working longer hours', 'By prioritizing tasks', 'By avoiding all responsibilities', 'By multitasking constantly'],
                        'correct_answer' => 1
                    ]
                ]),
                'points_per_question' => 10,
                'is_active' => true,
                'available_from' => Carbon::now(),
                'available_until' => Carbon::now()->addMonths(12),
                'locale' => 'en',
                'icon_path' => 'shield'
            ],
            [
                'title' => 'Hydration and Health',
                'description' => 'Understand the importance of proper hydration and its effects on body functions and wellness.',
                'questions' => json_encode([
                    [
                        'id' => 1,
                        'text' => 'What percentage of the human body is water?',
                        'options' => ['45%', '60%', '75%', '90%'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 2,
                        'text' => 'Which is a sign of dehydration?',
                        'options' => ['Clear urine', 'Increased energy', 'Dark yellow urine', 'Better concentration'],
                        'correct_answer' => 2
                    ],
                    [
                        'id' => 3,
                        'text' => 'When should you drink more water?',
                        'options' => ['Only when thirsty', 'During exercise', 'Never', 'Only with meals'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 4,
                        'text' => 'Which beverage contributes most to hydration?',
                        'options' => ['Coffee', 'Soda', 'Water', 'Energy drinks'],
                        'correct_answer' => 2
                    ],
                    [
                        'id' => 5,
                        'text' => 'How does proper hydration affect skin health?',
                        'options' => ['Makes it oily', 'Improves elasticity', 'Causes breakouts', 'Has no effect'],
                        'correct_answer' => 1
                    ]
                ]),
                'points_per_question' => 10,
                'is_active' => true,
                'available_from' => Carbon::now(),
                'available_until' => Carbon::now()->addMonths(12),
                'locale' => 'en',
                'icon_path' => 'heart'
            ],
            [
                'title' => 'Environmental Wellness',
                'description' => 'Explore how your environment affects your health and learn sustainable living practices.',
                'questions' => json_encode([
                    [
                        'id' => 1,
                        'text' => 'Which practice reduces environmental impact and improves health?',
                        'options' => ['Driving everywhere', 'Walking or biking', 'Using disposable items', 'Eating processed foods'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 2,
                        'text' => 'What is the benefit of indoor plants?',
                        'options' => ['They increase humidity', 'They improve air quality', 'They reduce noise', 'All of the above'],
                        'correct_answer' => 3
                    ],
                    [
                        'id' => 3,
                        'text' => 'Which is a sustainable food choice?',
                        'options' => ['Highly processed foods', 'Local, seasonal produce', 'Imported exotic fruits', 'Fast food'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 4,
                        'text' => 'How does spending time in nature benefit health?',
                        'options' => ['Reduces stress', 'Improves mood', 'Boosts immune system', 'All of the above'],
                        'correct_answer' => 3
                    ],
                    [
                        'id' => 5,
                        'text' => 'What is the best way to reduce plastic waste?',
                        'options' => ['Use more disposable items', 'Choose reusable alternatives', 'Ignore the problem', 'Buy more plastic products'],
                        'correct_answer' => 1
                    ]
                ]),
                'points_per_question' => 10,
                'is_active' => true,
                'available_from' => Carbon::now(),
                'available_until' => Carbon::now()->addMonths(12),
                'locale' => 'en',
                'icon_path' => 'crown'
            ],
            [
                'title' => 'Mindfulness and Meditation',
                'description' => 'Learn about mindfulness practices and meditation techniques for mental clarity and peace.',
                'questions' => json_encode([
                    [
                        'id' => 1,
                        'text' => 'What is mindfulness?',
                        'options' => ['Thinking about the future', 'Being present in the moment', 'Multitasking', 'Avoiding thoughts'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 2,
                        'text' => 'How long should beginners meditate?',
                        'options' => ['2 hours', '5-10 minutes', '30 seconds', '1 hour'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 3,
                        'text' => 'Which is a benefit of regular meditation?',
                        'options' => ['Increased anxiety', 'Better focus', 'More stress', 'Less sleep'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 4,
                        'text' => 'What should you do when your mind wanders during meditation?',
                        'options' => ['Get frustrated', 'Stop meditating', 'Gently return focus to breath', 'Think harder'],
                        'correct_answer' => 2
                    ],
                    [
                        'id' => 5,
                        'text' => 'Which environment is best for meditation?',
                        'options' => ['Noisy and bright', 'Quiet and comfortable', 'While driving', 'During meetings'],
                        'correct_answer' => 1
                    ]
                ]),
                'points_per_question' => 10,
                'is_active' => true,
                'available_from' => Carbon::now(),
                'available_until' => Carbon::now()->addMonths(12),
                'locale' => 'en',
                'icon_path' => 'lightning'
            ],
            [
                'title' => 'Work-Life Balance',
                'description' => 'Discover strategies for maintaining healthy boundaries between work and personal life.',
                'questions' => json_encode([
                    [
                        'id' => 1,
                        'text' => 'What is a sign of poor work-life balance?',
                        'options' => ['Regular exercise', 'Chronic exhaustion', 'Good relationships', 'Adequate sleep'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 2,
                        'text' => 'Which practice helps maintain work-life balance?',
                        'options' => ['Working weekends', 'Setting boundaries', 'Skipping breaks', 'Checking emails constantly'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 3,
                        'text' => 'How can you disconnect from work at home?',
                        'options' => ['Keep work emails open', 'Create a dedicated workspace', 'Work in bed', 'Never take breaks'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 4,
                        'text' => 'What is the benefit of taking regular breaks?',
                        'options' => ['Decreased productivity', 'Improved focus', 'More stress', 'Less creativity'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 5,
                        'text' => 'Which activity supports work-life balance?',
                        'options' => ['Working through lunch', 'Pursuing hobbies', 'Staying late every day', 'Skipping vacations'],
                        'correct_answer' => 1
                    ]
                ]),
                'points_per_question' => 10,
                'is_active' => true,
                'available_from' => Carbon::now(),
                'available_until' => Carbon::now()->addMonths(12),
                'locale' => 'en',
                'icon_path' => 'target'
            ],
            [
                'title' => 'Healthy Habits Formation',
                'description' => 'Learn the science behind habit formation and strategies for building lasting healthy behaviors.',
                'questions' => json_encode([
                    [
                        'id' => 1,
                        'text' => 'How long does it typically take to form a new habit?',
                        'options' => ['7 days', '21-66 days', '1 year', '3 days'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 2,
                        'text' => 'What is the most effective way to build a new habit?',
                        'options' => ['Start with big changes', 'Begin with small, consistent actions', 'Do it perfectly every time', 'Wait for motivation'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 3,
                        'text' => 'Which strategy helps maintain new habits?',
                        'options' => ['Habit stacking', 'Doing it randomly', 'Avoiding reminders', 'Making it complicated'],
                        'correct_answer' => 0
                    ],
                    [
                        'id' => 4,
                        'text' => 'What should you do when you miss a day of your new habit?',
                        'options' => ['Give up completely', 'Get back on track the next day', 'Wait until next month', 'Feel guilty for weeks'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 5,
                        'text' => 'Which factor is most important for habit success?',
                        'options' => ['Perfection', 'Consistency', 'Speed', 'Complexity'],
                        'correct_answer' => 1
                    ]
                ]),
                'points_per_question' => 10,
                'is_active' => true,
                'available_from' => Carbon::now(),
                'available_until' => Carbon::now()->addMonths(12),
                'locale' => 'en',
                'icon_path' => 'rocket'
            ]
        ];

        foreach ($quizzes as $quiz) {
            Quiz::create($quiz);
        }
    }
}
