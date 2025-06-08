<?php

namespace App\Services;

use App\Models\User;
use App\Models\EmailLog;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class EmailNotificationService
{
    /**
     * Enviar notificación de reto completado
     */
    public function sendChallengeCompletedNotification(User $user, $challengeData): bool
    {
        return $this->sendEmail($user, [
            'subject' => '¡Felicidades! Has completado un reto',
            'template' => 'emails.challenge-completed',
            'data' => [
                'user' => $user,
                'challenge' => $challengeData,
                'points_earned' => $challengeData->points,
                'completion_date' => now()->format('d/m/Y')
            ],
            'type' => 'challenge_completed'
        ]);
    }

    /**
     * Enviar notificación de insignia obtenida
     */
    public function sendBadgeEarnedNotification(User $user, $badgeData): bool
    {
        return $this->sendEmail($user, [
            'subject' => '¡Has ganado una nueva insignia!',
            'template' => 'emails.badge-earned',
            'data' => [
                'user' => $user,
                'badge' => $badgeData
            ],
            'type' => 'badge_earned'
        ]);
    }

    /**
     * Enviar recordatorio de cuestionario
     */
    public function sendQuizReminderNotification(User $user, $quizData): bool
    {
        return $this->sendEmail($user, [
            'subject' => 'Nuevo cuestionario disponible',
            'template' => 'emails.quiz-reminder',
            'data' => [
                'user' => $user,
                'quiz' => $quizData
            ],
            'type' => 'quiz_reminder'
        ]);
    }

    /**
     * Enviar resumen semanal de actividad
     */
    public function sendWeeklySummaryNotification(User $user, $summaryData): bool
    {
        return $this->sendEmail($user, [
            'subject' => 'Tu resumen semanal de actividad',
            'template' => 'emails.weekly-summary',
            'data' => [
                'user' => $user,
                'summary' => $summaryData
            ],
            'type' => 'weekly_summary'
        ]);
    }

    /**
     * Enviar email de bienvenida
     */
    public function sendWelcomeEmail(User $user): bool
    {
        return $this->sendEmail($user, [
            'subject' => '¡Bienvenido a VitalUp!',
            'template' => 'emails.welcome',
            'data' => [
                'user' => $user
            ],
            'type' => 'welcome'
        ]);
    }

    /**
     * Enviar notificación cuando el usuario se une a un reto
     * Incluye verificación para evitar duplicados
     */
    public function sendChallengeJoinedNotification(User $user, $challengeData): bool
    {
        // Verificar si ya se ha enviado un correo de este tipo para este reto en las últimas 24 horas
        $recentEmail = EmailLog::where('user_id', $user->id)
            ->where('email_type', 'challenge_joined')
            ->where('created_at', '>=', now()->subHours(24))
            ->where('status', 'sent')
            ->where('related_id', $challengeData->id)
            ->first();

        if ($recentEmail) {
            Log::info('Skipping duplicate challenge joined email for user: ' . $user->email . ', challenge: ' . $challengeData->title);
            return true; // Consideramos que ya se ha enviado correctamente
        }

        return $this->sendEmail($user, [
            'subject' => '¡Te has unido a un nuevo reto!',
            'template' => 'emails.challenge-joined',
            'data' => [
                'user' => $user,
                'challenge' => $challengeData
            ],
            'type' => 'challenge_joined',
            'related_id' => $challengeData->id
        ]);
    }

    /**
     * Enviar notificación cuando se completa un quiz
     */
    public function sendQuizCompletedNotification(User $user, $quiz, int $score, int $totalQuestions, int $pointsEarned): bool
    {
        $percentage = $totalQuestions > 0 ? round(($score / $totalQuestions) * 100, 1) : 0;

        return $this->sendEmail($user, [
            'subject' => '¡Has completado el quiz: ' . $quiz->title . '!',
            'template' => 'emails.quiz-completed',
            'data' => [
                'user' => $user,
                'quiz' => $quiz,
                'score' => $score,
                'total_questions' => $totalQuestions,
                'percentage' => $percentage,
                'points_earned' => $pointsEarned
            ],
            'type' => 'quiz_completed'
        ]);
    }

    /**
     * Enviar notificación de subida de nivel
     */
    public function sendLevelUpNotification(User $user, int $new_level, int $next_level_points): bool
    {
        return $this->sendEmail($user, [
            'subject' => '¡Has subido al nivel ' . $new_level . '!',
            'template' => 'emails.level-up',
            'data' => [
                'user' => $user,
                'new_level' => $new_level,
                'next_level_points' => $next_level_points
            ],
            'type' => 'level_up'
        ]);
    }

    /**
     * Enviar consejo diario según preferencias
     */
    public function sendDailyTipEmail(User $user, string $tip_category, string $tip_title, string $tip_content, array $action_steps): bool
    {
        $result = $this->sendEmail($user, [
            'subject' => 'Tu consejo de bienestar - VitalUp',
            'template' => 'emails.daily-tip',
            'data' => [
                'user' => $user,
                'tip_category' => $tip_category,
                'tip_title' => $tip_title,
                'tip_content' => $tip_content,
                'action_steps' => $action_steps
            ],
            'type' => 'daily_tip'
        ]);

        return $result;
    }

    /**
     * Verificar si debe enviar consejo diario según frecuencia
     */
    private function shouldSendDailyTip(User $user): bool
    {
        if (!$user->last_email_sent_at) {
            return true;
        }

        $daysSinceLastEmail = $user->last_email_sent_at->diffInDays(now());

        // Check based on user's email frequency preference
        switch ($user->email_frequency) {
            case 'daily':
                return $daysSinceLastEmail >= 1;
            case 'every_3_days':
                return $daysSinceLastEmail >= 3;
            case 'weekly':
                return $daysSinceLastEmail >= 7;
            default:
                return false; // Don't send if preference is not set or is 'never'
        }
    }

    /**
     * Send daily tip to user based on their preferences
     */
    public function sendDailyTip(User $user): bool
    {
        // Check if we should send a tip based on user's email frequency
        if (!$this->shouldSendDailyTip($user)) {
            return false;
        }

        // Get user's preferred language from their locale or default to 'es'
        $locale = $user->locale ?? 'es';

        // Get user interests to personalize the tip
        $interests = $user->interests ?? ['general'];

        // Handle if interests is a string (JSON)
        if (is_string($interests)) {
            $interests = json_decode($interests, true) ?? ['general'];
        }

        // Ensure interests is an array
        if (!is_array($interests) || empty($interests)) {
            $interests = ['general'];
        }

        // Get localized tip from database
        $tip = $this->getLocalizedDailyTips($locale, $interests);

        // Send the email
        $result = $this->sendDailyTipEmail(
            $user,
            $tip['category'] ?? 'general',
            $tip['title'],
            $tip['content'],
            $tip['action_steps']
        );

        // If email was sent successfully, update the last_email_sent_at timestamp
        if ($result) {
            $user->last_email_sent_at = now();
            $user->save();
        }

        return $result;
    }

    /**
     * Get localized daily tips based on locale and interests
     */
    private function getLocalizedDailyTips($locale, $interests)
    {
        // Get tips from database based on locale and interests
        $query = \App\Models\Tip::where('locale', $locale)
            ->where('is_active', true);

        // If user has specific interests, filter by those categories
        if (!empty($interests)) {
            $query->whereIn('category', $interests);
        }

        $tips = $query->get();

        // If no tips found for the locale or interests, fallback to English general tips
        if ($tips->isEmpty()) {
            $tips = \App\Models\Tip::where('locale', 'en')
                ->where('is_active', true)
                ->where('category', 'general')
                ->get();
        }

        // If still no tips, fallback to any English tips
        if ($tips->isEmpty()) {
            $tips = \App\Models\Tip::where('locale', 'en')
                ->where('is_active', true)
                ->get();
        }

        // Return random tip or fallback message
        if ($tips->isNotEmpty()) {
            $randomTip = $tips->random();
            return [
                'title' => $randomTip->title,
                'content' => $randomTip->content,
                'action_steps' => $randomTip->action_steps ?? []
            ];
        }

        // Fallback tip structure
        return [
            'title' => $locale === 'es' ? 'Bienestar diario' : 'Daily wellness',
            'content' => $locale === 'es'
                ? '¡Mantente saludable y cuídate!'
                : 'Stay healthy and take care of yourself!',
            'action_steps' => []
        ];
    }

    /**
     * Método genérico para enviar emails
     */
    private function sendEmail(User $user, array $params): bool
    {
        // Verificar preferencias de notificación del usuario (excepto para welcome y daily_tip)
        if (!in_array($params['type'], ['welcome', 'daily_tip'])) {
            $preferences = $user->preferences;

            if (!$preferences) {
                return false;
            }

            $notificationPreferences = $preferences->notification_preferences;

            // Verificar si el usuario ha desactivado este tipo de notificación
            switch ($params['type']) {
                case 'challenge_completed':
                    if (!$notificationPreferences['achievement_alerts']) {
                        return false;
                    }
                    break;
                case 'challenge_joined':
                    // Check both challenge_updates and achievement_alerts to ensure notifications are sent
                    if (!$notificationPreferences['challenge_updates'] && !$notificationPreferences['achievement_alerts']) {
                        return false;
                    }
                    break;
                case 'quiz_completed':
                    if (!$notificationPreferences['achievement_alerts']) {
                        return false;
                    }
                    break;
                case 'badge_earned':
                    if (!$notificationPreferences['achievement_alerts']) {
                        return false;
                    }
                    break;
                case 'level_up':
                    if (!$notificationPreferences['achievement_alerts']) {
                        return false;
                    }
                    break;
                case 'quiz_reminder':
                    if (!$notificationPreferences['quiz_reminders']) {
                        return false;
                    }
                    break;
                case 'weekly_summary':
                    if (!$notificationPreferences['weekly_summaries']) {
                        return false;
                    }
                    break;
            }
        }

        try {
            // Enviar el email
            Mail::send($params['template'], $params['data'], function ($message) use ($user, $params) {
                $message->to($user->email, $user->name)
                    ->subject($params['subject']);
            });

            // Registrar el envío en la base de datos
            $emailLogData = [
                'user_id' => $user->id,
                'email_type' => $params['type'],
                'status' => 'sent',
                'recipient' => $user->email
            ];

            // Add related_id if provided
            if (isset($params['related_id'])) {
                $emailLogData['related_id'] = $params['related_id'];
            }

            EmailLog::create($emailLogData);

            // Registrar el envío exitoso en el log
            Log::info($params['type'] . ' email sent successfully to user: ' . $user->email);

            return true;
        } catch (\Exception $e) {
            // Registrar el error
            Log::error('Error al enviar email: ' . $e->getMessage());

            // Registrar el fallo en la base de datos
            $errorLogData = [
                'user_id' => $user->id,
                'email_type' => $params['type'],
                'status' => 'failed',
                'recipient' => $user->email,
                'error_message' => $e->getMessage()
            ];

            // Add related_id if provided
            if (isset($params['related_id'])) {
                $errorLogData['related_id'] = $params['related_id'];
            }

            EmailLog::create($errorLogData);

            return false;
        }
    }
}
