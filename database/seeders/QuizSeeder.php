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

        // VitalUp Professional Wellness Quizzes
        $quizzes = [
            [
                'title' => 'Nutrition Fundamentals',
                'description' => 'Test your knowledge about essential nutrition principles and healthy eating habits.',
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
                        'text' => 'What percentage of your plate should be filled with vegetables according to healthy eating guidelines?',
                        'options' => ['25%', '50%', '75%', '10%'],
                        'correct_answer' => 1
                    ]
                ]),
                'points_per_question' => 10,
                'is_active' => true,
                'available_from' => Carbon::now(),
                'available_until' => Carbon::now()->addMonths(12),
                'locale' => 'en',
            ],
            [
                'title' => 'Mental Wellness Basics',
                'description' => 'Explore fundamental concepts of mental health and stress management techniques.',
                'questions' => json_encode([
                    [
                        'id' => 1,
                        'text' => 'What is the recommended duration for daily meditation for beginners?',
                        'options' => ['5-10 minutes', '30-45 minutes', '1-2 hours', '2-3 minutes'],
                        'correct_answer' => 0
                    ],
                    [
                        'id' => 2,
                        'text' => 'Which breathing technique is most effective for immediate stress relief?',
                        'options' => ['Rapid breathing', 'Deep diaphragmatic breathing', 'Holding breath', 'Shallow breathing'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 3,
                        'text' => 'How many hours of sleep do most adults need for optimal mental health?',
                        'options' => ['4-5 hours', '6-7 hours', '7-9 hours', '10+ hours'],
                        'correct_answer' => 2
                    ],
                    [
                        'id' => 4,
                        'text' => 'What is a key benefit of practicing gratitude regularly?',
                        'options' => ['Increased stress', 'Improved mood and outlook', 'Better physical strength', 'Enhanced memory only'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 5,
                        'text' => 'Which activity is proven to reduce anxiety and depression?',
                        'options' => ['Watching TV', 'Regular physical exercise', 'Eating more sugar', 'Avoiding social contact'],
                        'correct_answer' => 1
                    ]
                ]),
                'points_per_question' => 12,
                'is_active' => true,
                'available_from' => Carbon::now(),
                'available_until' => Carbon::now()->addMonths(12),
                'locale' => 'en',
            ],
            [
                'title' => 'Physical Fitness Essentials',
                'description' => 'Learn about exercise principles, fitness components, and healthy movement patterns.',
                'questions' => json_encode([
                    [
                        'id' => 1,
                        'text' => 'How many minutes of moderate exercise should adults get per week?',
                        'options' => ['75 minutes', '150 minutes', '300 minutes', '30 minutes'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 2,
                        'text' => 'What are the main components of physical fitness?',
                        'options' => ['Only strength', 'Cardio, strength, flexibility, balance', 'Just running', 'Only flexibility'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 3,
                        'text' => 'When is the best time to stretch for injury prevention?',
                        'options' => ['Only before exercise', 'Only after exercise', 'Both before and after exercise', 'Never stretch'],
                        'correct_answer' => 2
                    ],
                    [
                        'id' => 4,
                        'text' => 'What is the target heart rate zone for moderate exercise?',
                        'options' => ['50-70% of max heart rate', '85-95% of max heart rate', '30-40% of max heart rate', '100% of max heart rate'],
                        'correct_answer' => 0
                    ],
                    [
                        'id' => 5,
                        'text' => 'How often should strength training be performed?',
                        'options' => ['Daily', '2-3 times per week', 'Once per month', 'Only when feeling strong'],
                        'correct_answer' => 1
                    ]
                ]),
                'points_per_question' => 12,
                'is_active' => true,
                'available_from' => Carbon::now(),
                'available_until' => Carbon::now()->addMonths(12),
                'locale' => 'en',
            ],
            [
                'title' => 'Environmental Wellness',
                'description' => 'Understand how environmental factors impact health and learn sustainable living practices.',
                'questions' => json_encode([
                    [
                        'id' => 1,
                        'text' => 'What is the most effective way to reduce your carbon footprint?',
                        'options' => ['Use more plastic', 'Reduce, reuse, recycle', 'Drive more often', 'Use more electricity'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 2,
                        'text' => 'How does spending time in nature benefit mental health?',
                        'options' => ['It doesn\'t help', 'Reduces stress and improves mood', 'Only helps physical health', 'Makes you more anxious'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 3,
                        'text' => 'What is a simple way to improve indoor air quality?',
                        'options' => ['Keep windows closed always', 'Add houseplants', 'Use more chemicals', 'Increase humidity to 90%'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 4,
                        'text' => 'Which transportation method is most environmentally friendly?',
                        'options' => ['Large SUV', 'Walking or cycling', 'Private jet', 'Motorcycle'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 5,
                        'text' => 'What percentage of waste can typically be recycled or composted?',
                        'options' => ['10-20%', '70-80%', '5%', '100%'],
                        'correct_answer' => 1
                    ]
                ]),
                'points_per_question' => 15,
                'is_active' => true,
                'available_from' => Carbon::now(),
                'available_until' => Carbon::now()->addMonths(12),
                'locale' => 'en',
            ],
            [
                'title' => 'Social Wellness & Relationships',
                'description' => 'Explore the importance of social connections and healthy relationship building.',
                'questions' => json_encode([
                    [
                        'id' => 1,
                        'text' => 'What is the most important skill for building strong relationships?',
                        'options' => ['Talking more', 'Active listening', 'Being right always', 'Avoiding conflict'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 2,
                        'text' => 'How do strong social connections impact health?',
                        'options' => ['No impact', 'Improve immune system and longevity', 'Only affect mood', 'Make you weaker'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 3,
                        'text' => 'What is emotional intelligence?',
                        'options' => ['Being very smart', 'Understanding and managing emotions', 'Having no emotions', 'Only helping others'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 4,
                        'text' => 'How can volunteering benefit your wellness?',
                        'options' => ['It\'s just work', 'Increases purpose and social connection', 'Wastes time', 'Only helps others'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 5,
                        'text' => 'What is a healthy way to handle conflict in relationships?',
                        'options' => ['Avoid it completely', 'Communicate openly and respectfully', 'Always win arguments', 'Get angry quickly'],
                        'correct_answer' => 1
                    ]
                ]),
                'points_per_question' => 12,
                'is_active' => true,
                'available_from' => Carbon::now(),
                'available_until' => Carbon::now()->addMonths(12),
                'locale' => 'en',
            ],
            [
                'title' => 'Sleep & Recovery Science',
                'description' => 'Learn about sleep cycles, recovery processes, and optimizing rest for better health.',
                'questions' => json_encode([
                    [
                        'id' => 1,
                        'text' => 'What happens during REM sleep?',
                        'options' => ['Nothing important', 'Memory consolidation and dreaming', 'Only physical rest', 'Digestion only'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 2,
                        'text' => 'What is the ideal bedroom temperature for sleep?',
                        'options' => ['80-85°F', '60-67°F', '70-75°F', '50-55°F'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 3,
                        'text' => 'How long before bedtime should you avoid screens?',
                        'options' => ['No need to avoid', '1-2 hours', '10 minutes', '4-5 hours'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 4,
                        'text' => 'What hormone regulates sleep-wake cycles?',
                        'options' => ['Insulin', 'Melatonin', 'Adrenaline', 'Cortisol'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 5,
                        'text' => 'Which activity promotes better sleep quality?',
                        'options' => ['Late-night exercise', 'Regular sleep schedule', 'Caffeine before bed', 'Large meals before sleep'],
                        'correct_answer' => 1
                    ]
                ]),
                'points_per_question' => 10,
                'is_active' => true,
                'available_from' => Carbon::now(),
                'available_until' => Carbon::now()->addMonths(12),
                'locale' => 'en',
            ],
            [
                'title' => 'Stress Management Mastery',
                'description' => 'Master techniques for managing stress and building resilience in daily life.',
                'questions' => json_encode([
                    [
                        'id' => 1,
                        'text' => 'What is the first step in effective stress management?',
                        'options' => ['Ignore the stress', 'Identify stress triggers', 'Work harder', 'Avoid all challenges'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 2,
                        'text' => 'Which technique helps activate the body\'s relaxation response?',
                        'options' => ['Rapid thinking', 'Progressive muscle relaxation', 'Multitasking', 'Skipping meals'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 3,
                        'text' => 'How does chronic stress affect the immune system?',
                        'options' => ['Strengthens it', 'Weakens it', 'No effect', 'Only affects mood'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 4,
                        'text' => 'What is a healthy coping mechanism for stress?',
                        'options' => ['Substance abuse', 'Regular exercise and meditation', 'Social isolation', 'Overeating'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 5,
                        'text' => 'Which mindset helps build resilience?',
                        'options' => ['Fixed mindset', 'Growth mindset', 'Negative thinking', 'Perfectionism'],
                        'correct_answer' => 1
                    ]
                ]),
                'points_per_question' => 15,
                'is_active' => true,
                'available_from' => Carbon::now(),
                'available_until' => Carbon::now()->addMonths(12),
                'locale' => 'en',
            ],
            [
                'title' => 'Holistic Wellness Integration',
                'description' => 'Advanced quiz covering the integration of all wellness dimensions for optimal health.',
                'questions' => json_encode([
                    [
                        'id' => 1,
                        'text' => 'What does holistic wellness mean?',
                        'options' => ['Only physical health', 'Balance of mind, body, and spirit', 'Just mental health', 'Only nutrition'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 2,
                        'text' => 'How are the different dimensions of wellness connected?',
                        'options' => ['They\'re completely separate', 'They influence each other', 'Only some are connected', 'Connection doesn\'t matter'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 3,
                        'text' => 'What is the key to sustainable wellness habits?',
                        'options' => ['Extreme changes', 'Gradual, consistent improvements', 'Perfect execution', 'Following trends'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 4,
                        'text' => 'How should you approach setbacks in your wellness journey?',
                        'options' => ['Give up completely', 'Learn and adjust your approach', 'Blame external factors', 'Start over from scratch'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 5,
                        'text' => 'What role does community play in wellness?',
                        'options' => ['No role', 'Provides support and accountability', 'Only creates pressure', 'Slows progress'],
                        'correct_answer' => 1
                    ]
                ]),
                'points_per_question' => 20,
                'is_active' => true,
                'available_from' => Carbon::now(),
                'available_until' => Carbon::now()->addMonths(12),
                'locale' => 'en',
            ],
        ];

        foreach ($quizzes as $quiz) {
            Quiz::create($quiz);
        }
    }
}
