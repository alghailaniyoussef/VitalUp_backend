<?php

namespace Database\Seeders;

use App\Models\Tip;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key checks and clear existing tips
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Tip::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // VitalUp Professional Wellness Tips
        $tips = [
            // General Wellness Tips
            [
                'title' => 'Start your day with intention',
                'content' => 'Begin each morning by setting a positive intention for the day. Take 2-3 minutes to visualize how you want to feel and what you want to accomplish. This simple practice can significantly improve your mental clarity and overall well-being.',
                'category' => 'general',
                'locale' => 'en',
                'action_steps' => [
                    'Dedicate 2-3 minutes each morning to reflection',
                    'Visualize how you want to feel during the day',
                    'Set a clear and positive intention'
                ],
                'is_active' => true,
            ],
            [
                'title' => 'The Power of Deep Breathing',
                'content' => 'Practice the 4-7-8 breathing technique: Inhale for 4 counts, hold for 7, exhale for 8. This activates your parasympathetic nervous system, reducing stress and promoting relaxation. Perfect for moments of anxiety or before sleep.',
                'category' => 'general',
                'locale' => 'en',
                'is_active' => true,
            ],
            [
                'title' => 'Hydration for Vitality',
                'content' => 'Start your day with a glass of water and aim for 8-10 glasses throughout the day. Add lemon or cucumber for flavor and extra nutrients. Proper hydration boosts energy, improves skin health, and supports cognitive function.',
                'category' => 'general',
                'locale' => 'en',
                'is_active' => true,
            ],
            [
                'title' => 'Digital Wellness Break',
                'content' => 'Follow the 20-20-20 rule: Every 20 minutes, look at something 20 feet away for 20 seconds. This reduces eye strain and mental fatigue from screen time. Set gentle reminders to maintain this healthy habit.',
                'category' => 'general',
                'locale' => 'en',
                'is_active' => true,
            ],
            [
                'title' => 'Gratitude Practice',
                'content' => 'Write down three things you\'re grateful for each evening. This simple practice rewires your brain for positivity, improves sleep quality, and enhances overall life satisfaction. Focus on specific details to maximize the benefit.',
                'category' => 'general',
                'locale' => 'en',
                'is_active' => true,
            ],

            // Nutrition Tips
            [
                'title' => 'Rainbow Plate Principle',
                'content' => 'Aim to eat a variety of colorful fruits and vegetables daily. Different colors provide different nutrients and antioxidants. Try to include red, orange, yellow, green, blue, and purple foods in your weekly meal plan.',
                'category' => 'nutrition',
                'locale' => 'en',
                'is_active' => true,
            ],
            [
                'title' => 'Mindful Eating Practice',
                'content' => 'Eat without distractions like TV or phones. Chew slowly and savor each bite. This improves digestion, helps you recognize fullness cues, and enhances the enjoyment of your meals.',
                'category' => 'nutrition',
                'locale' => 'en',
                'is_active' => true,
            ],
            [
                'title' => 'Protein Power',
                'content' => 'Include a source of protein in every meal to maintain stable blood sugar levels and support muscle health. Great options include lean meats, fish, eggs, beans, nuts, and Greek yogurt.',
                'category' => 'nutrition',
                'locale' => 'en',
                'is_active' => true,
            ],
            [
                'title' => 'Smart Snacking',
                'content' => 'Prepare healthy snacks in advance: cut vegetables, portion nuts, or prepare fruit. Having nutritious options readily available prevents impulsive food choices and maintains steady energy levels.',
                'category' => 'nutrition',
                'locale' => 'en',
                'is_active' => true,
            ],
            [
                'title' => 'Meal Prep Success',
                'content' => 'Dedicate 1-2 hours on weekends to prepare meals for the week. Cook grains, chop vegetables, and prepare proteins in advance. This saves time, reduces stress, and ensures you always have healthy options available.',
                'category' => 'nutrition',
                'locale' => 'en',
                'is_active' => true,
            ],

            // Fitness Tips
            [
                'title' => 'Movement Snacks',
                'content' => 'Take 2-3 minute movement breaks every hour. Do desk stretches, walk around, or perform bodyweight exercises. These "movement snacks" boost circulation, energy, and productivity throughout the day.',
                'category' => 'fitness',
                'locale' => 'en',
                'is_active' => true,
            ],
            [
                'title' => 'Strength Training Basics',
                'content' => 'Incorporate strength training 2-3 times per week. Start with bodyweight exercises like squats, push-ups, and planks. Progressive overload is key - gradually increase difficulty as you get stronger.',
                'category' => 'fitness',
                'locale' => 'en',
                'is_active' => true,
            ],
            [
                'title' => 'Walking for Wellness',
                'content' => 'Aim for 10,000 steps daily, but remember that any movement counts. Take stairs instead of elevators, park farther away, or have walking meetings. Walking improves cardiovascular health and mental clarity.',
                'category' => 'fitness',
                'locale' => 'en',
                'is_active' => true,
            ],
            [
                'title' => 'Flexibility Focus',
                'content' => 'Dedicate 10-15 minutes daily to stretching or yoga. Focus on major muscle groups and hold stretches for 30 seconds. Regular stretching improves mobility, reduces injury risk, and relieves muscle tension.',
                'category' => 'fitness',
                'locale' => 'en',
                'is_active' => true,
            ],
            [
                'title' => 'Active Recovery',
                'content' => 'On rest days, engage in light activities like gentle yoga, walking, or swimming. Active recovery promotes blood flow, reduces muscle soreness, and maintains momentum in your fitness journey.',
                'category' => 'fitness',
                'locale' => 'en',
                'is_active' => true,
            ],

            // Mental Health Tips
            [
                'title' => 'Meditation Made Simple',
                'content' => 'Start with just 5 minutes of daily meditation. Use apps like Headspace or simply focus on your breath. Consistency matters more than duration. Gradually increase time as the habit becomes established.',
                'category' => 'mental_health',
                'locale' => 'en',
                'is_active' => true,
            ],
            [
                'title' => 'Stress Reset Technique',
                'content' => 'When feeling overwhelmed, use the STOP technique: Stop what you\'re doing, Take a breath, Observe your thoughts and feelings, Proceed with awareness. This creates space between stimulus and response.',
                'category' => 'mental_health',
                'locale' => 'en',
                'is_active' => true,
            ],
            [
                'title' => 'Boundary Setting',
                'content' => 'Learn to say "no" to commitments that don\'t align with your values or overwhelm your schedule. Healthy boundaries protect your energy and allow you to show up fully for what matters most.',
                'category' => 'mental_health',
                'locale' => 'en',
                'is_active' => true,
            ],
            [
                'title' => 'Nature Therapy',
                'content' => 'Spend at least 20 minutes in nature daily, even if it\'s just sitting by a window with plants. Nature exposure reduces cortisol levels, improves mood, and enhances cognitive function.',
                'category' => 'mental_health',
                'locale' => 'en',
                'is_active' => true,
            ],
            [
                'title' => 'Positive Self-Talk',
                'content' => 'Notice your inner dialogue and replace self-criticism with self-compassion. Speak to yourself as you would to a good friend. This shift in internal communication significantly impacts mental well-being.',
                'category' => 'mental_health',
                'locale' => 'en',
                'is_active' => true,
            ],

            // Sleep Tips
            [
                'title' => 'Sleep Sanctuary Setup',
                'content' => 'Create an optimal sleep environment: keep your bedroom cool (60-67°F), dark, and quiet. Invest in blackout curtains, comfortable bedding, and consider a white noise machine if needed.',
                'category' => 'sleep',
                'locale' => 'en',
                'is_active' => true,
            ],
            [
                'title' => 'Digital Sunset',
                'content' => 'Stop using electronic devices 1-2 hours before bedtime. Blue light interferes with melatonin production. Instead, try reading, gentle stretching, or meditation to prepare for sleep.',
                'category' => 'sleep',
                'locale' => 'en',
                'is_active' => true,
            ],
            [
                'title' => 'Consistent Sleep Schedule',
                'content' => 'Go to bed and wake up at the same time every day, even on weekends. This strengthens your circadian rhythm and improves sleep quality. Your body thrives on predictable patterns.',
                'category' => 'sleep',
                'locale' => 'en',
                'is_active' => true,
            ],
            [
                'title' => 'Pre-Sleep Ritual',
                'content' => 'Develop a calming bedtime routine: dim lights, take a warm bath, practice gentle stretches, or write in a journal. This signals to your body that it\'s time to wind down and prepare for rest.',
                'category' => 'sleep',
                'locale' => 'en',
                'is_active' => true,
            ],
            [
                'title' => 'Morning Light Exposure',
                'content' => 'Get natural sunlight within the first hour of waking. This helps regulate your circadian rhythm and improves nighttime sleep quality. Even 10-15 minutes makes a difference.',
                'category' => 'sleep',
                'locale' => 'en',
                'is_active' => true,
            ],

            // Productivity Tips
            [
                'title' => 'Time Blocking Method',
                'content' => 'Schedule specific time blocks for different activities, including breaks and personal time. This prevents overcommitment and ensures important tasks get adequate attention.',
                'category' => 'productivity',
                'locale' => 'en',
                'is_active' => true,
            ],
            [
                'title' => 'Two-Minute Rule',
                'content' => 'If a task takes less than two minutes, do it immediately rather than adding it to your to-do list. This prevents small tasks from accumulating and becoming overwhelming.',
                'category' => 'productivity',
                'locale' => 'en',
                'is_active' => true,
            ],
            [
                'title' => 'Energy Management',
                'content' => 'Schedule your most important work during your peak energy hours. Notice when you feel most alert and focused, then protect this time for your highest-priority tasks.',
                'category' => 'productivity',
                'locale' => 'en',
                'is_active' => true,
            ],
            [
                'title' => 'Single-Tasking Focus',
                'content' => 'Focus on one task at a time instead of multitasking. This improves quality, reduces errors, and actually saves time. Use techniques like the Pomodoro method to maintain focus.',
                'category' => 'productivity',
                'locale' => 'en',
                'is_active' => true,
            ],
            [
                'title' => 'Weekly Review Practice',
                'content' => 'Spend 15-20 minutes each week reviewing your goals, accomplishments, and upcoming priorities. This keeps you aligned with your objectives and helps you make necessary adjustments.',
                'category' => 'productivity',
                'locale' => 'en',
                'is_active' => true,
            ],

            // Social Wellness Tips
            [
                'title' => 'Active Listening Skills',
                'content' => 'Practice giving your full attention when others speak. Put away devices, maintain eye contact, and ask thoughtful questions. This strengthens relationships and builds deeper connections.',
                'category' => 'social',
                'locale' => 'en',
                'is_active' => true,
            ],
            [
                'title' => 'Quality Time Investment',
                'content' => 'Schedule regular one-on-one time with important people in your life. Quality matters more than quantity - even 30 minutes of focused attention can strengthen relationships significantly.',
                'category' => 'social',
                'locale' => 'en',
                'is_active' => true,
            ],
            [
                'title' => 'Community Connection',
                'content' => 'Join groups or activities aligned with your interests. Whether it\'s a book club, hiking group, or volunteer organization, shared activities create natural opportunities for meaningful connections.',
                'category' => 'social',
                'locale' => 'en',
                'is_active' => true,
            ],
            [
                'title' => 'Empathy Practice',
                'content' => 'Before responding in conversations, try to understand the other person\'s perspective. Ask yourself: "What might they be feeling?" This builds empathy and improves communication.',
                'category' => 'social',
                'locale' => 'en',
                'is_active' => true,
            ],
            [
                'title' => 'Gratitude Expression',
                'content' => 'Regularly express appreciation to people in your life. Send a thank-you text, write a note, or simply say "I appreciate you." Gratitude strengthens relationships and spreads positivity.',
                'category' => 'social',
                'locale' => 'en',
                'is_active' => true,
            ],

            // Environmental Tips
            [
                'title' => 'Green Space Creation',
                'content' => 'Add plants to your living and working spaces. Plants improve air quality, reduce stress, and create a more pleasant environment. Start with low-maintenance options like pothos or snake plants.',
                'category' => 'environmental',
                'locale' => 'en',
                'is_active' => true,
            ],
            [
                'title' => 'Sustainable Swaps',
                'content' => 'Make one sustainable swap each month: reusable water bottle, bamboo toothbrush, or cloth shopping bags. Small changes add up to significant environmental impact over time.',
                'category' => 'environmental',
                'locale' => 'en',
                'is_active' => true,
            ],
            [
                'title' => 'Mindful Consumption',
                'content' => 'Before making purchases, ask: "Do I really need this?" and "Will this add value to my life?" Mindful consumption reduces waste and saves money while promoting intentional living.',
                'category' => 'environmental',
                'locale' => 'en',
                'is_active' => true,
            ],
            [
                'title' => 'Energy Conservation',
                'content' => 'Develop energy-saving habits: unplug devices when not in use, use LED bulbs, and adjust your thermostat by 2-3 degrees. These small actions reduce your carbon footprint and utility bills.',
                'category' => 'environmental',
                'locale' => 'en',
                'is_active' => true,
            ],
            [
                'title' => 'Local Support',
                'content' => 'Support local businesses and farmers markets when possible. This reduces transportation emissions, supports your community\'s economy, and often provides fresher, higher-quality products.',
                'category' => 'environmental',
                'locale' => 'en',
                'is_active' => true,
            ],
        ];

        foreach ($tips as $tip) {
            Tip::create($tip);
        }
    }
}
