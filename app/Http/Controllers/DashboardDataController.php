<?php

namespace App\Http\Controllers;

use App\Models\ChallengeLog;
use App\Models\Tip;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use App\Services\TranslationService;

class DashboardDataController extends Controller
{
    /**
     * Get dashboard data for the authenticated user
     */
    public function index(Request $request) {
        $user = $request->user();
        $locale = $request->header('Accept-Language', 'en');
        // Extract locale from header like 'en-US' or 'es-ES'
        $locale = substr($locale, 0, 2);
        Log::info('✅ User:', [$request->user()]);

        return response()->json([
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ],
            'points' => $user->points ?? 0,
            'level' => $user->level ?? 1,
            'completed_challenges' => $user->challenges()->wherePivot('status', 'completed')->distinct()->count(),
            'badges_count' => $user->badges()->count(),
            'reminders' => ['Beber agua', 'Meditar', 'Caminar'],
            'tip' => $this->getDailyTip($user->id, $locale),
        ]);
    }

    /**
     * Get a daily health tip that changes every 24 hours
     *
     * @param int $userId User ID to create a unique cache key
     * @param string $locale Language locale for translations
     * @return string The daily health tip
     */
    private function getDailyTip($userId, $locale)
    {
        $cacheKey = "daily_tip_{$userId}_{$locale}_" . date('Y-m-d');
        
        return Cache::remember($cacheKey, 3600, function () use ($locale) {
            // Try to get a tip from the database first
            $tip = Tip::where('is_active', true)
                ->where('locale', $locale)
                ->inRandomOrder()
                ->first();
            
            if ($tip) {
                return $tip->content;
            }
            
            // Fallback to hardcoded tips
            $localizedTips = $this->getLocalizedTips($locale);
            return $localizedTips[array_rand($localizedTips)];
        });
    }

    /**
     * Get localized health tips
     *
     * @param string $locale Language locale
     * @return array Array of health tips
     */
    private function getLocalizedTips($locale) {
        $tips = [
            'en' => [
                'Drinking at least 8 glasses of water a day helps keep your body hydrated and functioning properly.',
                'Include fruits and vegetables of different colors in your diet to get a variety of nutrients.',
                'Take small breaks during the day to reduce stress and improve your concentration.',
                'Sleeping 7-9 hours daily is essential for your physical and mental health.',
                'Regular physical activity improves your mood and reduces the risk of chronic diseases.',
                'Practicing gratitude daily can improve your emotional well-being and reduce stress.',
                'Limit screen time before bed to improve your sleep quality.',
                'Incorporate omega-3 rich foods like fish, nuts and seeds into your diet.',
                'Maintain correct posture, especially if you spend a lot of time sitting.',
                'Practice deep breathing techniques to reduce anxiety and improve concentration.',
                'Set healthy boundaries between work and your personal life.',
                'Dedicate time to activities you enjoy and that make you happy.',
                'Stay socially connected with friends and family to improve your mental health.',
                'Incorporate stretching exercises into your daily routine to improve flexibility.',
                'Listen to your body and rest when you need it.'
            ],
            'es' => [
                'Beber al menos 8 vasos de agua al día ayuda a mantener tu cuerpo hidratado y funcionando correctamente.',
                'Incluye frutas y verduras de diferentes colores en tu dieta para obtener una variedad de nutrientes.',
                'Toma pequeños descansos durante el día para reducir el estrés y mejorar tu concentración.',
                'Dormir entre 7-9 horas diarias es esencial para tu salud física y mental.',
                'La actividad física regular mejora tu estado de ánimo y reduce el riesgo de enfermedades crónicas.',
                'Practicar la gratitud diariamente puede mejorar tu bienestar emocional y reducir el estrés.',
                'Limita el tiempo frente a pantallas antes de dormir para mejorar la calidad de tu sueño.',
                'Incorpora alimentos ricos en omega-3 como pescados, nueces y semillas en tu dieta.',
                'Mantén una postura correcta, especialmente si pasas mucho tiempo sentado.',
                'Practica técnicas de respiración profunda para reducir la ansiedad y mejorar la concentración.',
                'Establece límites saludables entre el trabajo y tu vida personal.',
                'Dedica tiempo a actividades que disfrutes y te hagan feliz.',
                'Mantente socialmente conectado con amigos y familiares para mejorar tu salud mental.',
                'Incorpora ejercicios de estiramiento en tu rutina diaria para mejorar la flexibilidad.',
                'Escucha a tu cuerpo y descansa cuando lo necesites.'
            ]
        ];

        return $tips[$locale] ?? $tips['en'];
    }
}
