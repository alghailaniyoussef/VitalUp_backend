<?php

namespace App\Services;

use App\Models\User;
use App\Models\EmailLog;
use App\Models\Challenge;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;

class HealthNotificationService
{
    protected $emailService;

    public function __construct(EmailNotificationService $emailService)
    {
        $this->emailService = $emailService;
    }

    /**
     * Enviar recordatorio de hidratación
     */
    public function sendHydrationReminder(User $user): void
    {
        Log::info('Enviando recordatorio de hidratación a: ' . $user->email);

        // Datos para el recordatorio
        $reminderData = [
            'title' => 'Recordatorio de hidratación',
            'message' => '¡Es hora de beber agua! Mantente hidratado para mejorar tu salud.',
            'tips' => [
                'Intenta beber al menos 8 vasos de agua al día',
                'Lleva una botella de agua contigo siempre',
                'Configura recordatorios regulares para hidratarte'
            ]
        ];

        // Enviar notificación por correo
        $this->emailService->sendEmail($user, [
            'subject' => 'Recordatorio: Mantente hidratado',
            'template' => 'emails.health-reminder',
            'data' => [
                'user' => $user,
                'reminder' => $reminderData
            ],
            'type' => 'hydration_reminder'
        ]);

        // Actualizar último recordatorio enviado
        $user->last_email_sent_at = now();
        $user->save();
    }

    /**
     * Enviar recordatorio de actividad física
     */
    public function sendExerciseReminder(User $user): void
    {
        Log::info('Enviando recordatorio de actividad física a: ' . $user->email);

        // Datos para el recordatorio
        $reminderData = [
            'title' => 'Recordatorio de actividad física',
            'message' => '¡Es momento de moverte! Incluso una pequeña caminata puede mejorar tu salud.',
            'tips' => [
                'Intenta hacer al menos 30 minutos de actividad física al día',
                'Incorpora pequeñas pausas activas durante tu jornada',
                'Busca actividades que disfrutes para mantenerte motivado'
            ]
        ];

        // Enviar notificación por correo
        $this->emailService->sendEmail($user, [
            'subject' => 'Recordatorio: Mantente activo',
            'template' => 'emails.health-reminder',
            'data' => [
                'user' => $user,
                'reminder' => $reminderData
            ],
            'type' => 'exercise_reminder'
        ]);

        // Actualizar último recordatorio enviado
        $user->last_email_sent_at = now();
        $user->save();
    }

    /**
     * Enviar consejo de salud mental
     */
    public function sendMentalHealthTip(User $user): void
    {
        Log::info('Enviando consejo de salud mental a: ' . $user->email);

        // Lista de consejos de salud mental
        $tips = [
            'Practica la meditación durante 5 minutos al día',
            'Toma pequeños descansos durante tu jornada para reducir el estrés',
            'Mantén un diario de gratitud para enfocarte en lo positivo',
            'Establece límites saludables entre el trabajo y tu vida personal',
            'Busca actividades que te hagan feliz y dedícales tiempo regularmente'
        ];

        // Seleccionar un consejo aleatorio
        $randomTip = $tips[array_rand($tips)];

        // Datos para el consejo
        $tipData = [
            'title' => 'Consejo de salud mental',
            'message' => '¡Cuida tu mente! Tu bienestar mental es tan importante como tu salud física.',
            'tip' => $randomTip
        ];

        // Enviar notificación por correo
        $this->emailService->sendEmail($user, [
            'subject' => 'Consejo de bienestar: Salud mental',
            'template' => 'emails.health-tip',
            'data' => [
                'user' => $user,
                'tip' => $tipData
            ],
            'type' => 'mental_health_tip'
        ]);

        // Actualizar último consejo enviado
        $user->last_email_sent_at = now();
        $user->save();
    }

    /**
     * Enviar recordatorio de reto de salud semanal
     */
    public function sendWeeklyHealthChallenge(User $user): void
    {
        Log::info('Enviando reto semanal de salud a: ' . $user->email);

        // Obtener un reto aleatorio de la categoría de salud
        $challenge = Challenge::where('category', 'physical')
            ->where('is_active', true)
            ->inRandomOrder()
            ->first();

        if (!$challenge) {
            Log::warning('No se encontraron retos de salud activos para enviar');
            return;
        }

        // Datos para el reto
        $challengeData = [
            'title' => $challenge->title,
            'description' => $challenge->description,
            'duration' => $challenge->duration_days . ' días',
            'points' => $challenge->points_reward
        ];

        // Enviar notificación por correo
        $this->emailService->sendEmail($user, [
            'subject' => 'Tu reto semanal de salud',
            'template' => 'emails.weekly-challenge',
            'data' => [
                'user' => $user,
                'challenge' => $challengeData
            ],
            'type' => 'weekly_health_challenge'
        ]);

        // Actualizar último reto enviado
        $user->last_email_sent_at = now();
        $user->save();
    }

    /**
     * Programar notificaciones de salud según preferencias del usuario
     */
    public function scheduleHealthNotifications(User $user): void
    {
        // Verificar preferencias de notificación
        $preferences = $user->preferences;

        if (!$preferences || !isset($preferences->notification_preferences['email_frequency'])) {
            Log::info('Usuario sin preferencias de notificación configuradas: ' . $user->id);
            return;
        }

        $frequency = $preferences->notification_preferences['email_frequency'];
        $lastEmailSent = $user->last_email_sent_at;

        // Determinar si es momento de enviar notificación según frecuencia
        $shouldSendNotification = false;

        if (!$lastEmailSent) {
            $shouldSendNotification = true;
        } else {
            switch ($frequency) {
                case 'daily':
                    $shouldSendNotification = $lastEmailSent->diffInDays(now()) >= 1;
                    break;
                case 'three_days':
                    $shouldSendNotification = $lastEmailSent->diffInDays(now()) >= 3;
                    break;
                case 'weekly':
                    $shouldSendNotification = $lastEmailSent->diffInDays(now()) >= 7;
                    break;
                default:
                    $shouldSendNotification = $lastEmailSent->diffInDays(now()) >= 7;
            }
        }

        if (!$shouldSendNotification) {
            Log::info('No es momento de enviar notificación según frecuencia para usuario: ' . $user->id);
            return;
        }

        // Seleccionar aleatoriamente qué tipo de notificación enviar
        $notificationTypes = ['hydration', 'exercise', 'mental_health', 'weekly_challenge'];
        $selectedType = $notificationTypes[array_rand($notificationTypes)];

        switch ($selectedType) {
            case 'hydration':
                $this->sendHydrationReminder($user);
                break;
            case 'exercise':
                $this->sendExerciseReminder($user);
                break;
            case 'mental_health':
                $this->sendMentalHealthTip($user);
                break;
            case 'weekly_challenge':
                $this->sendWeeklyHealthChallenge($user);
                break;
        }
    }
}
