<?php

namespace App\Services;

class TranslationService
{
    /**
     * Get translations for challenge categories
     */
    public static function getChallengeCategories($locale = 'en')
    {
        $translations = [
            'en' => [
                'fitness' => 'Fitness',
                'nutrition' => 'Nutrition',
                'mental_health' => 'Mental Health',
                'sleep' => 'Sleep',
                'wellness' => 'Wellness',
                'physical' => 'Physical',
                'mental' => 'Mental',
                'social' => 'Social',
                'environmental' => 'Environmental'
            ],
            'es' => [
                'fitness' => 'Fitness',
                'nutrition' => 'Nutrición',
                'mental_health' => 'Salud Mental',
                'sleep' => 'Sueño',
                'wellness' => 'Bienestar',
                'physical' => 'Físico',
                'mental' => 'Mental',
                'social' => 'Social',
                'environmental' => 'Ambiental'
            ]
        ];

        return $translations[$locale] ?? $translations['en'];
    }

    /**
     * Get translations for challenge difficulties
     */
    public static function getChallengeDifficulties($locale = 'en')
    {
        $translations = [
            'en' => [
                'beginner' => 'Beginner',
                'intermediate' => 'Intermediate',
                'advanced' => 'Advanced'
            ],
            'es' => [
                'beginner' => 'Principiante',
                'intermediate' => 'Intermedio',
                'advanced' => 'Avanzado'
            ]
        ];

        return $translations[$locale] ?? $translations['en'];
    }

    /**
     * Get translations for challenge statuses
     */
    public static function getChallengeStatuses($locale = 'en')
    {
        $translations = [
            'en' => [
                'active' => 'Active',
                'completed' => 'Completed',
                'abandoned' => 'Abandoned',
                'not_started' => 'Not Started'
            ],
            'es' => [
                'active' => 'Activo',
                'completed' => 'Completado',
                'abandoned' => 'Abandonado',
                'not_started' => 'No Iniciado'
            ]
        ];

        return $translations[$locale] ?? $translations['en'];
    }

    /**
     * Get translations for tip categories
     */
    public static function getTipCategories($locale = 'en')
    {
        $translations = [
            'en' => [
                'general' => 'General Wellness',
                'nutrition' => 'Nutrition',
                'fitness' => 'Fitness',
                'mental_health' => 'Mental Health',
                'sleep' => 'Sleep',
                'productivity' => 'Productivity',
                'social' => 'Social Wellness',
                'environmental' => 'Environmental'
            ],
            'es' => [
                'general' => 'Bienestar General',
                'nutrition' => 'Nutrición',
                'fitness' => 'Fitness',
                'mental_health' => 'Salud Mental',
                'sleep' => 'Sueño',
                'productivity' => 'Productividad',
                'social' => 'Bienestar Social',
                'environmental' => 'Ambiental'
            ]
        ];

        return $translations[$locale] ?? $translations['en'];
    }

    /**
     * Get translations for interest categories
     */
    public static function getInterestCategories($locale = 'en')
    {
        $translations = [
            'en' => [
                'physical' => 'Physical',
                'mental' => 'Mental',
                'sleep' => 'Sleep',
                'nutrition' => 'Nutrition',
                'wellness' => 'Wellness',
                'social' => 'Social',
                'environmental' => 'Environmental',
                'fitness' => 'Fitness',
                'mental_health' => 'Mental Health',
                'running' => 'Running',
                'cycling' => 'Cycling',
                'swimming' => 'Swimming',
                'hiking' => 'Hiking',
                'yoga' => 'Yoga',
                'meditation' => 'Meditation',
                'stress_management' => 'Stress Management',
                'work_life_balance' => 'Work-Life Balance',
                'social_wellness' => 'Social Wellness',
                'sustainability' => 'Sustainability',
                'eco_friendly' => 'Eco-Friendly'
            ],
            'es' => [
                'physical' => 'Físico',
                'mental' => 'Mental',
                'sleep' => 'Sueño',
                'nutrition' => 'Nutrición',
                'wellness' => 'Bienestar',
                'social' => 'Social',
                'environmental' => 'Ambiental',
                'fitness' => 'Fitness',
                'mental_health' => 'Salud Mental',
                'running' => 'Correr',
                'cycling' => 'Ciclismo',
                'swimming' => 'Natación',
                'hiking' => 'Senderismo',
                'yoga' => 'Yoga',
                'meditation' => 'Meditación',
                'stress_management' => 'Manejo del Estrés',
                'work_life_balance' => 'Equilibrio Vida-Trabajo',
                'social_wellness' => 'Bienestar Social',
                'sustainability' => 'Sostenibilidad',
                'eco_friendly' => 'Ecológico'
            ]
        ];

        return $translations[$locale] ?? $translations['en'];
    }

    /**
     * Get translations for quiz categories
     */
    public static function getQuizCategories($locale = 'en')
    {
        $translations = [
            'en' => [
                'nutrition' => 'Nutrition',
                'fitness' => 'Fitness',
                'mental_health' => 'Mental Health',
                'sleep' => 'Sleep',
                'general' => 'General Wellness',
                'hydration' => 'Hydration',
                'stress_management' => 'Stress Management',
                'weight_management' => 'Weight Management',
                'heart_health' => 'Heart Health',
                'bone_health' => 'Bone Health',
                'immune_system' => 'Immune System',
                'digestive_health' => 'Digestive Health',
                'skin_health' => 'Skin Health',
                'eye_health' => 'Eye Health',
                'brain_health' => 'Brain Health',
                'respiratory_health' => 'Respiratory Health',
                'hormonal_health' => 'Hormonal Health',
                'addiction_recovery' => 'Addiction Recovery',
                'chronic_disease' => 'Chronic Disease Management',
                'preventive_care' => 'Preventive Care'
            ],
            'es' => [
                'nutrition' => 'Nutrición',
                'fitness' => 'Fitness',
                'mental_health' => 'Salud Mental',
                'sleep' => 'Sueño',
                'general' => 'Bienestar General',
                'hydration' => 'Hidratación',
                'stress_management' => 'Manejo del Estrés',
                'weight_management' => 'Control de Peso',
                'heart_health' => 'Salud Cardíaca',
                'bone_health' => 'Salud Ósea',
                'immune_system' => 'Sistema Inmunológico',
                'digestive_health' => 'Salud Digestiva',
                'skin_health' => 'Salud de la Piel',
                'eye_health' => 'Salud Ocular',
                'brain_health' => 'Salud Cerebral',
                'respiratory_health' => 'Salud Respiratoria',
                'hormonal_health' => 'Salud Hormonal',
                'addiction_recovery' => 'Recuperación de Adicciones',
                'chronic_disease' => 'Manejo de Enfermedades Crónicas',
                'preventive_care' => 'Cuidado Preventivo'
            ]
        ];

        return $translations[$locale] ?? $translations['en'];
    }

    /**
     * Get translations for quiz titles
     */
    public static function getQuizTitles($locale = 'en')
    {
        $translations = [
            'en' => [
                'Nutrition Fundamentals' => 'Nutrition Fundamentals',
                'Fitness Basics' => 'Fitness Basics',
                'Mental Health Awareness' => 'Mental Health Awareness',
                'Sleep Hygiene' => 'Sleep Hygiene',
                'Stress Management Techniques' => 'Stress Management Techniques',
                'Hydration and Health' => 'Hydration and Health',
                'Heart Health Essentials' => 'Heart Health Essentials',
                'Weight Management Strategies' => 'Weight Management Strategies',
                'Immune System Boosters' => 'Immune System Boosters',
                'Comprehensive Wellness Assessment' => 'Comprehensive Wellness Assessment'
            ],
            'es' => [
                'Nutrition Fundamentals' => 'Fundamentos de Nutrición',
                'Fitness Basics' => 'Conceptos Básicos de Fitness',
                'Mental Health Awareness' => 'Conciencia de Salud Mental',
                'Sleep Hygiene' => 'Higiene del Sueño',
                'Stress Management Techniques' => 'Técnicas de Manejo del Estrés',
                'Hydration and Health' => 'Hidratación y Salud',
                'Heart Health Essentials' => 'Fundamentos de Salud Cardíaca',
                'Weight Management Strategies' => 'Estrategias de Control de Peso',
                'Immune System Boosters' => 'Potenciadores del Sistema Inmunológico',
                'Comprehensive Wellness Assessment' => 'Evaluación Integral de Bienestar'
            ]
        ];

        return $translations[$locale] ?? $translations['en'];
    }

    /**
     * Get translations for quiz descriptions
     */
    public static function getQuizDescriptions($locale = 'en')
    {
        $translations = [
            'en' => [
                'Test your knowledge of essential nutrition principles and learn how to make healthier food choices for optimal wellness.' => 'Test your knowledge of essential nutrition principles and learn how to make healthier food choices for optimal wellness.',
                'Discover the fundamentals of physical fitness and learn effective exercise strategies for a healthier lifestyle.' => 'Discover the fundamentals of physical fitness and learn effective exercise strategies for a healthier lifestyle.',
                'Explore mental health concepts and learn practical strategies for maintaining psychological well-being.' => 'Explore mental health concepts and learn practical strategies for maintaining psychological well-being.',
                'Learn about the importance of quality sleep and discover techniques for improving your sleep hygiene.' => 'Learn about the importance of quality sleep and discover techniques for improving your sleep hygiene.',
                'Master effective stress management techniques and learn how to maintain balance in your daily life.' => 'Master effective stress management techniques and learn how to maintain balance in your daily life.',
                'Understand the critical role of hydration in health and learn optimal fluid intake strategies.' => 'Understand the critical role of hydration in health and learn optimal fluid intake strategies.',
                'Learn essential principles for maintaining cardiovascular health and preventing heart disease.' => 'Learn essential principles for maintaining cardiovascular health and preventing heart disease.',
                'Discover evidence-based strategies for healthy weight management and sustainable lifestyle changes.' => 'Discover evidence-based strategies for healthy weight management and sustainable lifestyle changes.',
                'Learn how to strengthen your immune system through lifestyle choices and healthy habits.' => 'Learn how to strengthen your immune system through lifestyle choices and healthy habits.',
                'Advanced quiz covering the integration of all wellness dimensions for optimal health.' => 'Advanced quiz covering the integration of all wellness dimensions for optimal health.'
            ],
            'es' => [
                'Test your knowledge of essential nutrition principles and learn how to make healthier food choices for optimal wellness.' => 'Pon a prueba tu conocimiento de los principios esenciales de nutrición y aprende a tomar decisiones alimentarias más saludables para un bienestar óptimo.',
                'Discover the fundamentals of physical fitness and learn effective exercise strategies for a healthier lifestyle.' => 'Descubre los fundamentos del fitness físico y aprende estrategias de ejercicio efectivas para un estilo de vida más saludable.',
                'Explore mental health concepts and learn practical strategies for maintaining psychological well-being.' => 'Explora conceptos de salud mental y aprende estrategias prácticas para mantener el bienestar psicológico.',
                'Learn about the importance of quality sleep and discover techniques for improving your sleep hygiene.' => 'Aprende sobre la importancia del sueño de calidad y descubre técnicas para mejorar tu higiene del sueño.',
                'Master effective stress management techniques and learn how to maintain balance in your daily life.' => 'Domina técnicas efectivas de manejo del estrés y aprende a mantener el equilibrio en tu vida diaria.',
                'Understand the critical role of hydration in health and learn optimal fluid intake strategies.' => 'Comprende el papel crítico de la hidratación en la salud y aprende estrategias óptimas de ingesta de líquidos.',
                'Learn essential principles for maintaining cardiovascular health and preventing heart disease.' => 'Aprende principios esenciales para mantener la salud cardiovascular y prevenir enfermedades cardíacas.',
                'Discover evidence-based strategies for healthy weight management and sustainable lifestyle changes.' => 'Descubre estrategias basadas en evidencia para el control saludable del peso y cambios sostenibles en el estilo de vida.',
                'Learn how to strengthen your immune system through lifestyle choices and healthy habits.' => 'Aprende cómo fortalecer tu sistema inmunológico a través de decisiones de estilo de vida y hábitos saludables.',
                'Advanced quiz covering the integration of all wellness dimensions for optimal health.' => 'Cuestionario avanzado que cubre la integración de todas las dimensiones del bienestar para una salud óptima.'
            ]
        ];

        return $translations[$locale] ?? $translations['en'];
    }

    /**
     * Get translations for badge types
     */
    public static function getBadgeTypes($locale = 'en')
    {
        $translations = [
            'en' => [
                'quiz' => 'Quiz Achievement',
                'challenge' => 'Challenge Achievement',
                'points' => 'Points Achievement',
                'level' => 'Level Achievement',
                'streak' => 'Streak Achievement',
                'special' => 'Special Achievement'
            ],
            'es' => [
                'quiz' => 'Logro de Cuestionario',
                'challenge' => 'Logro de Desafío',
                'points' => 'Logro de Puntos',
                'level' => 'Logro de Nivel',
                'streak' => 'Logro de Racha',
                'special' => 'Logro Especial'
            ]
        ];

        return $translations[$locale] ?? $translations['en'];
    }

    /**
     * Get translations for points history source types
     */
    public static function getPointsSourceTypes($locale = 'en')
    {
        $translations = [
            'en' => [
                'quiz' => 'Quiz Completion',
                'badge' => 'Badge Earned',
                'challenge' => 'Challenge Completion',
                'daily_login' => 'Daily Login',
                'referral' => 'Referral Bonus',
                'bonus' => 'Bonus Points',
                'manual' => 'Manual Adjustment'
            ],
            'es' => [
                'quiz' => 'Finalización de Cuestionario',
                'badge' => 'Insignia Obtenida',
                'challenge' => 'Finalización de Desafío',
                'daily_login' => 'Inicio de Sesión Diario',
                'referral' => 'Bono de Referido',
                'bonus' => 'Puntos de Bonificación',
                'manual' => 'Ajuste Manual'
            ]
        ];

        return $translations[$locale] ?? $translations['en'];
    }

    /**
     * Translate a single value
     */
    public static function translate($type, $value, $locale = 'en')
    {
        switch ($type) {
            case 'challenge_category':
                $translations = self::getChallengeCategories($locale);
                break;
            case 'challenge_difficulty':
                $translations = self::getChallengeDifficulties($locale);
                break;
            case 'challenge_status':
                $translations = self::getChallengeStatuses($locale);
                break;
            case 'tip_category':
                $translations = self::getTipCategories($locale);
                break;
            case 'interest_category':
                $translations = self::getInterestCategories($locale);
                break;
            case 'quiz_category':
                $translations = self::getQuizCategories($locale);
                break;
            case 'quiz_title':
                $translations = self::getQuizTitles($locale);
                break;
            case 'quiz_description':
                $translations = self::getQuizDescriptions($locale);
                break;
            case 'badge_type':
                $translations = self::getBadgeTypes($locale);
                break;
            case 'points_source_type':
                $translations = self::getPointsSourceTypes($locale);
                break;
            default:
                return $value;
        }

        return $translations[$value] ?? $value;
    }
}
