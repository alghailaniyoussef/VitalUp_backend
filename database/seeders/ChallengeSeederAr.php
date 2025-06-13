<?php

namespace Database\Seeders;

use App\Models\Challenge;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ChallengeSeederAr extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // VitalUp Professional Wellness Challenges - Arabic
        $challenges = [
            [
                'title' => 'روتين صباحي واعي',
                'description' => 'أسس روتينًا صباحيًا ثابتًا يضع نغمة إيجابية ليومك بأكمله. ركز على اليقظة والحركة والاستعداد الذهني.',
                'category' => 'mental',
                'difficulty' => 'beginner',
                'goals' => json_encode([
                    'الاستيقاظ مبكرًا 30 دقيقة كل يوم',
                    'ممارسة 10 دقائق من التأمل أو التنفس العميق',
                    'كتابة 3 أشياء تشعر بالامتنان لها',
                    'القيام بتمارين تمدد خفيفة لمدة 5 دقائق',
                    'تحديد النوايا والأولويات اليومية'
                ]),
                'duration_days' => 21,
                'points_reward' => 180,
                'badge_rewards' => json_encode(['سيد الصباح']),
                'is_active' => true,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addMonths(6),
                'locale' => 'ar',
            ],
            [
                'title' => 'تحدي بطل الترطيب',
                'description' => 'حول صحتك من خلال الحفاظ على مستويات مثالية من الترطيب طوال اليوم. تتبع استهلاكك للماء وطور عادات شرب صحية.',
                'category' => 'nutrition',
                'difficulty' => 'beginner',
                'goals' => json_encode([
                    'شرب 8 أكواب من الماء يوميًا',
                    'بدء كل يوم بكوب من الماء',
                    'استبدال مشروب سكري بالماء يوميًا',
                    'استخدام زجاجة ماء قابلة لإعادة الاستخدام باستمرار',
                    'تتبع مستويات الترطيب لمدة أسبوعين'
                ]),
                'duration_days' => 14,
                'points_reward' => 150,
                'badge_rewards' => json_encode(['بطل الترطيب']),
                'is_active' => true,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addMonths(6),
                'locale' => 'ar',
            ],
            [
                'title' => 'عطلة نهاية الأسبوع للتخلص من السموم الرقمية',
                'description' => 'استعد مساحتك الذهنية وحسن تركيزك من خلال تقليل وقت الشاشة والمشتتات الرقمية خلال عطلات نهاية الأسبوع.',
                'category' => 'mental',
                'difficulty' => 'intermediate',
                'goals' => json_encode([
                    'بدون وسائل التواصل الاجتماعي لمدة 48 ساعة',
                    'إيقاف الإشعارات غير الضرورية',
                    'المشاركة في أنشطة بعيدة عن الإنترنت لمدة 4+ ساعات يوميًا',
                    'ممارسة الأكل الواعي بدون شاشات',
                    'قراءة كتاب ورقي لمدة ساعة واحدة'
                ]),
                'duration_days' => 7,
                'points_reward' => 200,
                'badge_rewards' => json_encode(['بطل التخلص من السموم الرقمية']),
                'is_active' => true,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addMonths(6),
                'locale' => 'ar',
            ],
            [
                'title' => 'تحدي النقل النشط',
                'description' => 'أدخل المزيد من النشاط البدني في روتينك اليومي من خلال اختيار وسائل النقل النشطة.',
                'category' => 'fitness',
                'difficulty' => 'beginner',
                'goals' => json_encode([
                    'المشي أو ركوب الدراجة إلى العمل 3 مرات في الأسبوع',
                    'استخدام السلالم بدلاً من المصاعد',
                    'ركن السيارة بعيدًا لزيادة المشي',
                    'النزول من وسائل النقل العام قبل محطة واحدة',
                    'تتبع الخطوات اليومية والهدف هو 8,000+ خطوة'
                ]),
                'duration_days' => 21,
                'points_reward' => 170,
                'badge_rewards' => json_encode(['المسافر النشط']),
                'is_active' => true,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addMonths(6),
                'locale' => 'ar',
            ],
            [
                'title' => 'تحسين النوم بدون توتر',
                'description' => 'حسن جودة نومك وأسس روتينًا صحيًا لوقت النوم من أجل راحة واستعادة أفضل.',
                'category' => 'sleep',
                'difficulty' => 'intermediate',
                'goals' => json_encode([
                    'الحفاظ على جدول نوم ثابت (7-9 ساعات)',
                    'إنشاء روتين مريح لوقت النوم',
                    'تجنب الشاشات قبل ساعة من النوم',
                    'الحفاظ على غرفة النوم باردة ومظلمة',
                    'ممارسة تقنيات الاسترخاء قبل النوم'
                ]),
                'duration_days' => 28,
                'points_reward' => 220,
                'badge_rewards' => json_encode(['سيد النوم']),
                'is_active' => true,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addMonths(6),
                'locale' => 'ar',
            ],
            [
                'title' => 'تحدي الحياة المستدامة',
                'description' => 'تبنى ممارسات صديقة للبيئة تفيد صحتك والبيئة. اجعل الخيارات المستدامة جزءًا من روتينك اليومي.',
                'category' => 'environmental',
                'difficulty' => 'intermediate',
                'goals' => json_encode([
                    'استخدام أكياس قابلة لإعادة الاستخدام لجميع المشتريات',
                    'تقليل البلاستيك ذو الاستخدام الواحد بنسبة 80٪',
                    'البدء في تسميد النفايات العضوية',
                    'اختيار الأطعمة المحلية والعضوية عندما يكون ذلك ممكنًا',
                    'المشي أو ركوب الدراجة للرحلات التي تقل عن 2 ميل'
                ]),
                'duration_days' => 30,
                'points_reward' => 250,
                'badge_rewards' => json_encode(['محارب البيئة']),
                'is_active' => true,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addMonths(6),
                'locale' => 'ar',
            ],
            [
                'title' => 'رحلة بناء القوة',
                'description' => 'ابنِ قوة وظيفية وحسن لياقتك البدنية من خلال تدريب المقاومة التدريجي.',
                'category' => 'fitness',
                'difficulty' => 'intermediate',
                'goals' => json_encode([
                    'إكمال 3 جلسات تدريب قوة أسبوعيًا',
                    'إتقان 5 تمارين بوزن الجسم',
                    'زيادة شدة التدريب تدريجيًا',
                    'تتبع التقدم والتحسينات',
                    'التركيز على الشكل والتقنية المناسبين'
                ]),
                'duration_days' => 42,
                'points_reward' => 300,
                'badge_rewards' => json_encode(['بطل القوة']),
                'is_active' => true,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addMonths(6),
                'locale' => 'ar',
            ],
            [
                'title' => 'تحدي التغذية الواعية',
                'description' => 'طور علاقة أكثر صحة مع الطعام من خلال ممارسات الأكل الواعي والوعي الغذائي.',
                'category' => 'nutrition',
                'difficulty' => 'beginner',
                'goals' => json_encode([
                    'تناول 5 حصص من الفواكه والخضروات يوميًا',
                    'ممارسة الأكل الواعي في جميع الوجبات',
                    'تحضير 4 وجبات منزلية أسبوعيًا',
                    'قراءة الملصقات الغذائية قبل الشراء',
                    'الاحتفاظ بمذكرة طعام لمدة أسبوعين'
                ]),
                'duration_days' => 21,
                'points_reward' => 190,
                'badge_rewards' => json_encode(['خبير التغذية']),
                'is_active' => true,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addMonths(6),
                'locale' => 'ar',
            ],
            [
                'title' => 'تعزيز التواصل الاجتماعي',
                'description' => 'قوي روابطك الاجتماعية ورفاهيتك العقلية من خلال إعطاء الأولوية للاتصالات الهادفة مع الآخرين.',
                'category' => 'mental',
                'difficulty' => 'beginner',
                'goals' => json_encode([
                    'إجراء محادثة هادفة يوميًا',
                    'التواصل مع صديق قديم كل أسبوع',
                    'المشاركة في نشاط مجتمعي',
                    'ممارسة مهارات الاستماع النشط',
                    'التعبير عن الامتنان لشخص ما يوميًا'
                ]),
                'duration_days' => 14,
                'points_reward' => 160,
                'badge_rewards' => json_encode(['متواصل اجتماعي']),
                'is_active' => true,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addMonths(6),
                'locale' => 'ar',
            ],
            [
                'title' => 'تحدي تحسين الطاقة',
                'description' => 'عزز مستويات طاقتك اليومية من خلال تغييرات استراتيجية في نمط الحياة وعادات صحية.',
                'category' => 'fitness',
                'difficulty' => 'advanced',
                'goals' => json_encode([
                    'الحفاظ على مواعيد وجبات ثابتة',
                    'أخذ استراحات طاقة لمدة 10 دقائق كل ساعتين',
                    'ممارسة تمارين التنفس العميق 3 مرات يوميًا',
                    'تحسين بيئة العمل المريحة',
                    'تتبع مستويات الطاقة وتحديد الأنماط'
                ]),
                'duration_days' => 35,
                'points_reward' => 280,
                'badge_rewards' => json_encode(['سيد الطاقة']),
                'is_active' => true,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addMonths(6),
                'locale' => 'ar',
            ],
        ];

        foreach ($challenges as $challenge) {
            Challenge::create($challenge);
        }
    }
}