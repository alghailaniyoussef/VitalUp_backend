<?php

namespace Database\Seeders;

use App\Models\Quiz;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class QuizSeederEnAdditional extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // VitalUp Professional Wellness Quizzes - English (Additional 15)
        $quizzes = [
            [
                'title' => 'Digestive Health',
                'description' => 'Understand the fundamentals of digestive health and how to maintain a healthy digestive system.',
                'questions' => json_encode([
                    [
                        'id' => 1,
                        'text' => 'Which food is best for gut health?',
                        'options' => ['Processed foods', 'Probiotic yogurt', 'Fast food', 'Sugary drinks'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 2,
                        'text' => 'How much fiber should adults consume daily?',
                        'options' => ['10-15 grams', '25-35 grams', '50-60 grams', '5-10 grams'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 3,
                        'text' => 'What practice improves digestion?',
                        'options' => ['Eating quickly', 'Chewing food thoroughly', 'Drinking lots of water during meals', 'Skipping meals'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 4,
                        'text' => 'What is a sign of a healthy gut?',
                        'options' => ['Frequent constipation', 'Regular bowel movements', 'Constant bloating', 'Abdominal pain'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 5,
                        'text' => 'What can damage gut flora?',
                        'options' => ['Probiotics', 'Excessive antibiotics', 'Vegetables', 'Exercise'],
                        'correct_answer' => 1
                    ]
                ]),
                'points_per_question' => 10,
                'is_active' => true,
                'available_from' => Carbon::now(),
                'available_until' => Carbon::now()->addMonths(12),
                'locale' => 'en',
                'icon_path' => 'diamond'
            ],
            [
                'title' => 'Cardiovascular Health',
                'description' => 'Learn about heart health and strategies to maintain a strong cardiovascular system.',
                'questions' => json_encode([
                    [
                        'id' => 1,
                        'text' => 'What is a risk factor for heart disease?',
                        'options' => ['Regular exercise', 'Smoking', 'Eating fruits', 'Getting enough sleep'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 2,
                        'text' => 'Which type of fat is best for heart health?',
                        'options' => ['Trans fats', 'Saturated fats', 'Monounsaturated fats', 'Margarine'],
                        'correct_answer' => 2
                    ],
                    [
                        'id' => 3,
                        'text' => 'What is normal blood pressure?',
                        'options' => ['140/90 mmHg', '120/80 mmHg', '160/100 mmHg', '100/60 mmHg'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 4,
                        'text' => 'What exercise is best for the heart?',
                        'options' => ['Weight lifting only', 'Aerobic exercise', 'Stretching only', 'Isometric exercises'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 5,
                        'text' => 'How many minutes of cardiovascular exercise are recommended per week?',
                        'options' => ['75 minutes', '150 minutes', '300 minutes', '30 minutes'],
                        'correct_answer' => 1
                    ]
                ]),
                'points_per_question' => 10,
                'is_active' => true,
                'available_from' => Carbon::now(),
                'available_until' => Carbon::now()->addMonths(12),
                'locale' => 'en',
                'icon_path' => 'fire'
            ],
            [
                'title' => 'Personal Energy Management',
                'description' => 'Discover how to optimize your energy levels throughout the day for peak performance.',
                'questions' => json_encode([
                    [
                        'id' => 1,
                        'text' => 'What is the best way to maintain stable energy?',
                        'options' => ['Eating sugar', 'Regular balanced meals', 'Skipping meals', 'Caffeine only'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 2,
                        'text' => 'What causes the afternoon energy dip?',
                        'options' => ['Natural circadian rhythm', 'Too much exercise', 'Too much water', 'Fresh air'],
                        'correct_answer' => 0
                    ],
                    [
                        'id' => 3,
                        'text' => 'What is a natural way to boost energy?',
                        'options' => ['Energy drinks', 'Light exercise', 'More sugar', 'Sleeping over 10 hours'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 4,
                        'text' => 'Which nutrient is essential for energy production?',
                        'options' => ['B vitamins', 'Vitamin C', 'Vitamin D', 'Vitamin A'],
                        'correct_answer' => 0
                    ],
                    [
                        'id' => 5,
                        'text' => 'When is the best time to take a nap?',
                        'options' => ['Early morning', '20-30 minutes in the afternoon', 'Right before bed', 'For 2 hours'],
                        'correct_answer' => 1
                    ]
                ]),
                'points_per_question' => 10,
                'is_active' => true,
                'available_from' => Carbon::now(),
                'available_until' => Carbon::now()->addMonths(12),
                'locale' => 'en',
                'icon_path' => 'book'
            ],
            [
                'title' => 'Workplace Mental Health',
                'description' => 'Strategies for maintaining mental wellness in the workplace and managing professional stress.',
                'questions' => json_encode([
                    [
                        'id' => 1,
                        'text' => 'What is burnout syndrome?',
                        'options' => ['Excess energy', 'Physical and emotional exhaustion', 'Extreme motivation', 'Hyperactivity'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 2,
                        'text' => 'How can you manage workplace stress?',
                        'options' => ['Working longer hours', 'Taking regular breaks', 'Avoiding colleagues', 'Skipping lunch'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 3,
                        'text' => 'What practice helps with focus at work?',
                        'options' => ['Constant multitasking', 'Pomodoro Technique', 'Frequent distractions', 'Working non-stop'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 4,
                        'text' => 'What is a sign of workplace stress?',
                        'options' => ['Increased productivity', 'Frequent irritability', 'Better sleep', 'More energy'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 5,
                        'text' => 'What can improve workplace environment?',
                        'options' => ['Toxic competition', 'Open communication', 'Isolation', 'Constant criticism'],
                        'correct_answer' => 1
                    ]
                ]),
                'points_per_question' => 10,
                'is_active' => true,
                'available_from' => Carbon::now(),
                'available_until' => Carbon::now()->addMonths(12),
                'locale' => 'en',
                'icon_path' => 'graduation'
            ],
            [
                'title' => 'Injury Prevention',
                'description' => 'Learn techniques and strategies to prevent injuries during exercise and daily activities.',
                'questions' => json_encode([
                    [
                        'id' => 1,
                        'text' => 'What is the most common cause of sports injuries?',
                        'options' => ['Inadequate warm-up', 'Too much hydration', 'Slow exercise', 'Excessive rest'],
                        'correct_answer' => 0
                    ],
                    [
                        'id' => 2,
                        'text' => 'What should you do if you feel pain during exercise?',
                        'options' => ['Continue exercising', 'Stop and assess', 'Exercise harder', 'Ignore the pain'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 3,
                        'text' => 'What is the RICE rule for injuries?',
                        'options' => ['Run, Jump, Compress, Elevate', 'Rest, Ice, Compress, Elevate', 'Relax, Ignore, Continue, Exercise', 'Repeat, Intensify, Compete, Train'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 4,
                        'text' => 'What type of footwear is best for running?',
                        'options' => ['Dress shoes', 'Sandals', 'Proper athletic shoes', 'High heels'],
                        'correct_answer' => 2
                    ],
                    [
                        'id' => 5,
                        'text' => 'When should you seek medical help for an injury?',
                        'options' => ['Never', 'Only if there is visible fracture', 'If pain persists or worsens', 'Only after a week'],
                        'correct_answer' => 2
                    ]
                ]),
                'points_per_question' => 10,
                'is_active' => true,
                'available_from' => Carbon::now(),
                'available_until' => Carbon::now()->addMonths(12),
                'locale' => 'en',
                'icon_path' => 'checkmark'
            ],
            [
                'title' => 'Supplements and Vitamins',
                'description' => 'Understand the role of supplements in health and when they might be necessary.',
                'questions' => json_encode([
                    [
                        'id' => 1,
                        'text' => 'What is the best source of vitamins?',
                        'options' => ['Synthetic supplements', 'Whole foods', 'Energy drinks', 'Processed food'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 2,
                        'text' => 'Which vitamin is produced by sun exposure?',
                        'options' => ['Vitamin A', 'Vitamin C', 'Vitamin D', 'Vitamin E'],
                        'correct_answer' => 2
                    ],
                    [
                        'id' => 3,
                        'text' => 'When might supplements be necessary?',
                        'options' => ['Always', 'Never', 'When there are diagnosed deficiencies', 'Only for athletes'],
                        'correct_answer' => 2
                    ],
                    [
                        'id' => 4,
                        'text' => 'Which mineral is important for bones?',
                        'options' => ['Iron', 'Calcium', 'Zinc', 'Magnesium'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 5,
                        'text' => 'What can excess supplements cause?',
                        'options' => ['Better health', 'Toxicity', 'More energy', 'Weight loss'],
                        'correct_answer' => 1
                    ]
                ]),
                'points_per_question' => 10,
                'is_active' => true,
                'available_from' => Carbon::now(),
                'available_until' => Carbon::now()->addMonths(12),
                'locale' => 'en',
                'icon_path' => 'medal'
            ],
            [
                'title' => 'Technology and Wellness',
                'description' => 'Explore the relationship between technology and health, and how to use technology healthily.',
                'questions' => json_encode([
                    [
                        'id' => 1,
                        'text' => 'What is digital eye strain?',
                        'options' => ['Better vision', 'Eye fatigue from screens', 'Improved night vision', 'Color blindness'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 2,
                        'text' => 'What is the 20-20-20 rule for eye health?',
                        'options' => ['Look 20 feet away for 20 seconds every 20 minutes', 'Blink 20 times in 20 seconds', 'Use screens 20 hours a day', 'Rest 20 minutes every hour'],
                        'correct_answer' => 0
                    ],
                    [
                        'id' => 3,
                        'text' => 'How does blue light affect sleep?',
                        'options' => ['Improves sleep', 'Can interfere with sleep', 'Has no effect', 'Causes drowsiness'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 4,
                        'text' => 'What is ergonomic posture?',
                        'options' => ['Slouching', 'Position that reduces body strain', 'Standing all day', 'Sitting without support'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 5,
                        'text' => 'How long should you spend screen-free before bed?',
                        'options' => ['5 minutes', '1-2 hours', '30 seconds', 'It doesn\'t matter'],
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
                'title' => 'Skin Health',
                'description' => 'Learn about skin care and factors that affect skin health.',
                'questions' => json_encode([
                    [
                        'id' => 1,
                        'text' => 'What is the most important factor for skin health?',
                        'options' => ['Expensive products', 'Sun protection', 'Makeup', 'Perfumes'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 2,
                        'text' => 'What SPF is recommended for daily use?',
                        'options' => ['SPF 5', 'SPF 30 or higher', 'SPF 10', 'Not necessary'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 3,
                        'text' => 'Which nutrient is important for skin health?',
                        'options' => ['Vitamin C', 'Caffeine', 'Sugar', 'Alcohol'],
                        'correct_answer' => 0
                    ],
                    [
                        'id' => 4,
                        'text' => 'How does stress affect skin?',
                        'options' => ['Improves it', 'Can cause breakouts', 'Has no effect', 'Makes it younger'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 5,
                        'text' => 'What is the best way to cleanse skin?',
                        'options' => ['Scrub vigorously', 'Gentle cleansing', 'Use harsh soap', 'Don\'t cleanse'],
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
                'title' => 'Respiratory Health',
                'description' => 'Understand the importance of lung health and breathing techniques for wellness.',
                'questions' => json_encode([
                    [
                        'id' => 1,
                        'text' => 'What exercise improves lung capacity?',
                        'options' => ['Weight lifting only', 'Cardiovascular exercise', 'Stretching only', 'Arm exercises'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 2,
                        'text' => 'What is a breathing technique for relaxation?',
                        'options' => ['Rapid breathing', 'Diaphragmatic breathing', 'Holding breath', 'Mouth breathing'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 3,
                        'text' => 'What pollutes indoor air the most?',
                        'options' => ['Plants', 'Chemical cleaning products', 'Water', 'Books'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 4,
                        'text' => 'How many breaths per minute are normal at rest?',
                        'options' => ['5-8', '12-20', '30-40', '50-60'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 5,
                        'text' => 'What benefit does deep breathing have?',
                        'options' => ['Increases stress', 'Reduces relaxation', 'Activates parasympathetic nervous system', 'Causes anxiety'],
                        'correct_answer' => 2
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
                'title' => 'Hormonal Health',
                'description' => 'Explore the endocrine system and how to maintain healthy hormonal balance.',
                'questions' => json_encode([
                    [
                        'id' => 1,
                        'text' => 'Which hormone regulates sleep?',
                        'options' => ['Insulin', 'Melatonin', 'Adrenaline', 'Cortisol'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 2,
                        'text' => 'What can disrupt hormonal balance?',
                        'options' => ['Regular exercise', 'Chronic stress', 'Adequate sleep', 'Balanced nutrition'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 3,
                        'text' => 'What is the stress hormone?',
                        'options' => ['Insulin', 'Serotonin', 'Cortisol', 'Melatonin'],
                        'correct_answer' => 2
                    ],
                    [
                        'id' => 4,
                        'text' => 'What practice helps regulate hormones?',
                        'options' => ['Sleep deprivation', 'Regular exercise', 'Constant stress', 'Extreme fasting'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 5,
                        'text' => 'Which food can negatively affect hormones?',
                        'options' => ['Vegetables', 'Processed sugar', 'Fruits', 'Nuts'],
                        'correct_answer' => 1
                    ]
                ]),
                'points_per_question' => 10,
                'is_active' => true,
                'available_from' => Carbon::now(),
                'available_until' => Carbon::now()->addMonths(12),
                'locale' => 'en',
                'icon_path' => 'fire'
            ],
            [
                'title' => 'Longevity and Healthy Aging',
                'description' => 'Discover strategies for aging healthily and promoting longevity.',
                'questions' => json_encode([
                    [
                        'id' => 1,
                        'text' => 'What factor is most important for longevity?',
                        'options' => ['Genetics only', 'Healthy lifestyle', 'Luck', 'Medications'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 2,
                        'text' => 'What practice can slow aging?',
                        'options' => ['Smoking', 'Regular exercise', 'Chronic stress', 'Social isolation'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 3,
                        'text' => 'What are antioxidants?',
                        'options' => ['Substances that accelerate aging', 'Compounds that protect against cellular damage', 'Synthetic vitamins', 'Medications'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 4,
                        'text' => 'What is important for maintaining brain function?',
                        'options' => ['Isolation', 'Continuous learning', 'Avoiding challenges', 'Rigid routine'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 5,
                        'text' => 'What type of diet is associated with greater longevity?',
                        'options' => ['High processed diet', 'Mediterranean diet', 'High sugar diet', 'Extreme restrictive diet'],
                        'correct_answer' => 1
                    ]
                ]),
                'points_per_question' => 10,
                'is_active' => true,
                'available_from' => Carbon::now(),
                'available_until' => Carbon::now()->addMonths(12),
                'locale' => 'en',
                'icon_path' => 'diamond'
            ],
            [
                'title' => 'Immune System Health',
                'description' => 'Understand how the immune system works and how to strengthen it naturally.',
                'questions' => json_encode([
                    [
                        'id' => 1,
                        'text' => 'Which vitamin is crucial for immune system?',
                        'options' => ['Vitamin A', 'Vitamin C', 'Vitamin E', 'All of the above'],
                        'correct_answer' => 3
                    ],
                    [
                        'id' => 2,
                        'text' => 'What weakens the immune system?',
                        'options' => ['Moderate exercise', 'Adequate sleep', 'Chronic stress', 'Balanced nutrition'],
                        'correct_answer' => 2
                    ],
                    [
                        'id' => 3,
                        'text' => 'Where is most of the immune system located?',
                        'options' => ['Brain', 'Gut', 'Heart', 'Lungs'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 4,
                        'text' => 'What practice strengthens immunity?',
                        'options' => ['Sleep deprivation', 'Regular exercise', 'Constant stress', 'Restrictive diet'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 5,
                        'text' => 'Which food is good for immunity?',
                        'options' => ['Processed food', 'Garlic', 'Refined sugar', 'Alcohol'],
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
                'title' => 'Social Wellness',
                'description' => 'Explore the importance of social connections for mental and physical health.',
                'questions' => json_encode([
                    [
                        'id' => 1,
                        'text' => 'How does social isolation affect health?',
                        'options' => ['Improves it', 'Can be harmful', 'Has no effect', 'Only affects elderly'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 2,
                        'text' => 'What benefit do strong social relationships have?',
                        'options' => ['Increase stress', 'Improve longevity', 'Cause anxiety', 'Reduce immunity'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 3,
                        'text' => 'What is empathy?',
                        'options' => ['Ignoring others', 'Understanding others\' feelings', 'Being selfish', 'Avoiding emotions'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 4,
                        'text' => 'How can you improve social skills?',
                        'options' => ['Avoiding people', 'Practicing active listening', 'Being critical', 'Isolating yourself'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 5,
                        'text' => 'What activity promotes social wellness?',
                        'options' => ['Isolation', 'Volunteering', 'Toxic competition', 'Constant criticism'],
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
                'title' => 'Creativity and Wellness',
                'description' => 'Discover how creative activities contribute to mental and emotional wellbeing.',
                'questions' => json_encode([
                    [
                        'id' => 1,
                        'text' => 'How does creativity benefit mental health?',
                        'options' => ['Increases stress', 'Reduces stress', 'Causes anxiety', 'Has no effect'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 2,
                        'text' => 'What creative activity can improve mood?',
                        'options' => ['Criticizing art', 'Painting or drawing', 'Watching TV', 'Sleeping'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 3,
                        'text' => 'What is art therapy?',
                        'options' => ['Criticizing art', 'Using creativity for healing', 'Selling art', 'Collecting art'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 4,
                        'text' => 'How can music affect wellbeing?',
                        'options' => ['Only negatively', 'Can improve mood', 'Has no effect', 'Always causes stress'],
                        'correct_answer' => 1
                    ],
                    [
                        'id' => 5,
                        'text' => 'What benefit does journaling have?',
                        'options' => ['Increases confusion', 'Helps process emotions', 'Causes stress', 'Wastes time'],
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