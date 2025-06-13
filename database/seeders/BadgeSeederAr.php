<?php

namespace Database\Seeders;

use App\Models\Badge;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BadgeSeederAr extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Arabic badges - 15 badges matching English and Spanish versions
        $badges = [
            [
                'name' => 'كأس البطل',
                'description' => 'أكمل أول تحدي للعافية واحصل على كأس البطل',
                'icon_path' => 'trophy',
                'type' => 'challenge',
                'requirements' => json_encode(['challenge_count' => 1]),
                'points_reward' => 50,
                'is_active' => true,
                'locale' => 'ar',
            ],
            [
                'name' => 'وسام الشرف',
                'description' => 'أكمل 5 تحديات واحصل على وسام الشرف',
                'icon_path' => 'medal',
                'type' => 'challenge',
                'requirements' => json_encode(['challenge_count' => 5]),
                'points_reward' => 150,
                'is_active' => true,
                'locale' => 'ar',
            ],
            [
                'name' => 'النجم الصاعد',
                'description' => 'حقق درجة كاملة في أي اختبار من اختبارات فايتل أب',
                'icon_path' => 'star',
                'type' => 'quiz',
                'requirements' => json_encode(['min_score' => 100, 'quiz_count' => 1]),
                'points_reward' => 100,
                'is_active' => true,
                'locale' => 'ar',
            ],
            [
                'name' => 'تاج العافية',
                'description' => 'اصل إلى المستوى 10 وانضم إلى نخبة مجتمع فايتل أب',
                'icon_path' => 'crown',
                'type' => 'level',
                'requirements' => json_encode(['level_required' => 10]),
                'points_reward' => 300,
                'is_active' => true,
                'locale' => 'ar',
            ],
            [
                'name' => 'روح النار',
                'description' => 'أكمل الأنشطة لمدة 30 يومًا متتاليًا',
                'icon_path' => 'fire',
                'type' => 'challenge',
                'requirements' => json_encode(['consecutive_days' => 30]),
                'points_reward' => 400,
                'is_active' => true,
                'locale' => 'ar',
            ],
            [
                'name' => 'البرق السريع',
                'description' => 'أكمل 3 اختبارات في أقل من 5 دقائق لكل منها',
                'icon_path' => 'lightning',
                'type' => 'quiz',
                'requirements' => json_encode(['quick_completion' => 3]),
                'points_reward' => 200,
                'is_active' => true,
                'locale' => 'ar',
            ],
            [
                'name' => 'إنجاز الماس',
                'description' => 'اجمع 2000 نقطة من فايتل أب وأتقن النظام',
                'icon_path' => 'diamond',
                'type' => 'points',
                'requirements' => json_encode(['points_required' => 2000]),
                'points_reward' => 250,
                'is_active' => true,
                'locale' => 'ar',
            ],
            [
                'name' => 'درع الحارس',
                'description' => 'أكمل جميع تحديات العافية البيئية',
                'icon_path' => 'shield',
                'type' => 'challenge',
                'requirements' => json_encode(['specific_challenges' => [1, 2]]),
                'points_reward' => 120,
                'is_active' => true,
                'locale' => 'ar',
            ],
            [
                'name' => 'الهدف المثالي',
                'description' => 'حقق 90٪ أو أكثر في 10 اختبارات',
                'icon_path' => 'target',
                'type' => 'quiz',
                'requirements' => json_encode(['quiz_count' => 10, 'min_score' => 90]),
                'points_reward' => 300,
                'is_active' => true,
                'locale' => 'ar',
            ],
            [
                'name' => 'مطلق الصاروخ',
                'description' => 'انضم إلى فايتل أب في أيامها الأولى وكن جزءًا من المجتمع المؤسس',
                'icon_path' => 'rocket',
                'type' => 'special',
                'requirements' => json_encode(['special' => 'early_adopter']),
                'points_reward' => 200,
                'is_active' => true,
                'locale' => 'ar',
            ],
            [
                'name' => 'قوة العقل',
                'description' => 'أكمل 5 تحديات للعافية العقلية وحقق التوازن الداخلي',
                'icon_path' => 'brain',
                'type' => 'challenge',
                'requirements' => json_encode(['specific_challenges' => [3, 4], 'challenge_count' => 5]),
                'points_reward' => 150,
                'is_active' => true,
                'locale' => 'ar',
            ],
            [
                'name' => 'قلب ذهبي',
                'description' => 'أكمل تحديات العافية الاجتماعية وابنِ روابط ذات معنى',
                'icon_path' => 'heart',
                'type' => 'challenge',
                'requirements' => json_encode(['specific_challenges' => [5, 6]]),
                'points_reward' => 100,
                'is_active' => true,
                'locale' => 'ar',
            ],
            [
                'name' => 'باني العضلات',
                'description' => 'أكمل 15 تحديًا للعافية البدنية',
                'icon_path' => 'muscle',
                'type' => 'challenge',
                'requirements' => json_encode(['physical_challenges' => 15]),
                'points_reward' => 350,
                'is_active' => true,
                'locale' => 'ar',
            ],
            [
                'name' => 'كتاب المعرفة',
                'description' => 'أكمل 25 اختبارًا وأصبح خبيرًا حقيقيًا في العافية',
                'icon_path' => 'book',
                'type' => 'quiz',
                'requirements' => json_encode(['quiz_count' => 25, 'min_score' => 60]),
                'points_reward' => 500,
                'is_active' => true,
                'locale' => 'ar',
            ],
            [
                'name' => 'سيد التخرج',
                'description' => 'أكمل أول اختبار من فايتل أب وابدأ في بناء المعرفة',
                'icon_path' => 'graduation',
                'type' => 'quiz',
                'requirements' => json_encode(['quiz_count' => 1, 'min_score' => 50]),
                'points_reward' => 25,
                'is_active' => true,
                'locale' => 'ar',
            ],
        ];

        foreach ($badges as $badge) {
            Badge::create($badge);
        }
    }
}