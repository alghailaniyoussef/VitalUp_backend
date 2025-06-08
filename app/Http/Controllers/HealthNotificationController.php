<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tip;
use App\Services\HealthNotificationService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class HealthNotificationController extends Controller
{
    protected $healthNotificationService;

    public function __construct(HealthNotificationService $healthNotificationService)
    {
        $this->healthNotificationService = $healthNotificationService;
    }

    /**
     * Obtener recordatorios de salud activos para el usuario
     */
    public function getActiveReminders(): JsonResponse
    {
        $user = Auth::user();

        // Lista de recordatorios predefinidos
        $reminders = [
            [
                'id' => 1,
                'title' => 'Hidratación',
                'message' => 'Recuerda beber agua regularmente',
                'icon' => 'water_drop',
                'frequency' => 'daily',
                'active' => true
            ],
            [
                'id' => 2,
                'title' => 'Actividad física',
                'message' => 'Realiza al menos 30 minutos de actividad física',
                'icon' => 'directions_run',
                'frequency' => 'daily',
                'active' => true
            ],
            [
                'id' => 3,
                'title' => 'Meditación',
                'message' => 'Toma 5 minutos para meditar y reducir el estrés',
                'icon' => 'self_improvement',
                'frequency' => 'daily',
                'active' => true
            ],
            [
                'id' => 4,
                'title' => 'Descanso',
                'message' => 'Asegúrate de dormir al menos 7-8 horas',
                'icon' => 'bedtime',
                'frequency' => 'daily',
                'active' => true
            ]
        ];

        // Filtrar según preferencias del usuario (si existen)
        if ($user->preferences && isset($user->preferences->notification_preferences)) {
            // Implementación futura: filtrar según preferencias específicas
        }

        return response()->json($reminders);
    }

    /**
     * Actualizar preferencias de recordatorios de salud
     */
    public function updateReminderPreferences(Request $request): JsonResponse
    {
        $user = Auth::user();

        $validated = $request->validate([
            'reminders' => 'required|array',
            'reminders.*.id' => 'required|integer',
            'reminders.*.active' => 'required|boolean'
        ]);

        // Obtener preferencias actuales o crear nuevas
        $preferences = $user->preferences;
        if (!$preferences) {
            return response()->json(['message' => 'Preferencias de usuario no encontradas'], 404);
        }

        // Actualizar preferencias de recordatorios
        $notificationPreferences = $preferences->notification_preferences;
        $notificationPreferences['health_reminders'] = $validated['reminders'];

        $preferences->notification_preferences = $notificationPreferences;
        $preferences->save();

        return response()->json([
            'message' => 'Preferencias de recordatorios actualizadas con éxito',
            'preferences' => $preferences
        ]);
    }

    /**
     * Obtener consejos de salud para el usuario
     */
    public function getHealthTips(Request $request): JsonResponse
    {
        $locale = $request->header('Accept-Language', 'en');
        // Extract locale from header like 'en-US' or 'es-ES'
        $locale = substr($locale, 0, 2);

        // Get tips from database filtered by locale
        $tips = Tip::where('is_active', true)
            ->where('locale', $locale)
            ->get();

        if ($tips->isEmpty()) {
            // Fallback to hardcoded tips if no database tips found
            $hardcodedTips = $this->getLocalizedHealthTips($locale);
            $randomTip = $hardcodedTips[array_rand($hardcodedTips)];
        } else {
            // Select a random tip from database
            $randomTip = $tips->random();
        }

        return response()->json($randomTip);
    }

    /**
     * Get localized health tips
     *
     * @param string $locale Language locale
     * @return array Array of health tips
     */
    private function getLocalizedHealthTips($locale) {
        $tips = [
            'en' => [
                [
                    'id' => 1,
                    'category' => 'hydration',
                    'title' => 'Importance of Hydration',
                    'content' => 'Drinking enough water helps maintain body temperature, lubricate joints and transport nutrients.',
                    'icon' => 'water_drop'
                ],
                [
                    'id' => 2,
                    'category' => 'nutrition',
                    'title' => 'Balanced Diet',
                    'content' => 'Include fruits, vegetables, lean proteins and whole grains in your daily diet to get all the necessary nutrients.',
                    'icon' => 'nutrition'
                ],
                [
                    'id' => 3,
                    'category' => 'activity',
                    'title' => 'Benefits of Exercise',
                    'content' => 'Regular physical activity improves cardiovascular health, strengthens muscles and bones, and reduces the risk of chronic diseases.',
                    'icon' => 'fitness_center'
                ],
                [
                    'id' => 4,
                    'category' => 'mental',
                    'title' => 'Mental Health',
                    'content' => 'Practicing mindfulness and relaxation techniques can reduce stress and improve your emotional well-being.',
                    'icon' => 'psychology'
                ],
                [
                    'id' => 5,
                    'category' => 'rest',
                    'title' => 'Importance of Sleep',
                    'content' => 'Sleeping 7-9 hours daily is essential for physical and mental recovery, improving concentration and the immune system.',
                    'icon' => 'bedtime'
                ]
            ],
            'es' => [
                [
                    'id' => 1,
                    'category' => 'hidratación',
                    'title' => 'Importancia de la hidratación',
                    'content' => 'Beber suficiente agua ayuda a mantener la temperatura corporal, lubricar articulaciones y transportar nutrientes.',
                    'icon' => 'water_drop'
                ],
                [
                    'id' => 2,
                    'category' => 'nutrición',
                    'title' => 'Alimentación balanceada',
                    'content' => 'Incluye frutas, verduras, proteínas magras y granos enteros en tu dieta diaria para obtener todos los nutrientes necesarios.',
                    'icon' => 'nutrition'
                ],
                [
                    'id' => 3,
                    'category' => 'actividad',
                    'title' => 'Beneficios del ejercicio',
                    'content' => 'La actividad física regular mejora la salud cardiovascular, fortalece músculos y huesos, y reduce el riesgo de enfermedades crónicas.',
                    'icon' => 'fitness_center'
                ],
                [
                    'id' => 4,
                    'category' => 'mental',
                    'title' => 'Salud mental',
                    'content' => 'Practicar mindfulness y técnicas de relajación puede reducir el estrés y mejorar tu bienestar emocional.',
                    'icon' => 'psychology'
                ],
                [
                    'id' => 5,
                    'category' => 'descanso',
                    'title' => 'Importancia del sueño',
                    'content' => 'Dormir entre 7-9 horas diarias es esencial para la recuperación física y mental, mejorando la concentración y el sistema inmunológico.',
                    'icon' => 'bedtime'
                ]
            ]
        ];

        return $tips[$locale] ?? $tips['en'];
    }

    /**
     * Enviar recordatorio de salud manualmente
     */
    public function sendHealthReminder(Request $request): JsonResponse
    {
        $user = Auth::user();
        $reminderType = $request->input('type', 'hydration');

        try {
            switch ($reminderType) {
                case 'hydration':
                    $this->healthNotificationService->sendHydrationReminder($user);
                    $message = 'Recordatorio de hidratación enviado con éxito';
                    break;
                case 'exercise':
                    $this->healthNotificationService->sendExerciseReminder($user);
                    $message = 'Recordatorio de actividad física enviado con éxito';
                    break;
                case 'mental_health':
                    $this->healthNotificationService->sendMentalHealthTip($user);
                    $message = 'Consejo de salud mental enviado con éxito';
                    break;
                case 'weekly_challenge':
                    $this->healthNotificationService->sendWeeklyHealthChallenge($user);
                    $message = 'Reto semanal de salud enviado con éxito';
                    break;
                default:
                    $this->healthNotificationService->sendHydrationReminder($user);
                    $message = 'Recordatorio de salud enviado con éxito';
            }

            return response()->json(['message' => $message]);
        } catch (\Exception $e) {
            Log::error('Error al enviar recordatorio de salud: ' . $e->getMessage());
            return response()->json(['message' => 'Error al enviar recordatorio'], 500);
        }
    }
}
