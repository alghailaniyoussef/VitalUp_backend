<?php

namespace App\Listeners;

use App\Events\ChallengeJoined;
use App\Services\EmailNotificationService;
use Illuminate\Support\Facades\Log;

class SendChallengeJoinedEmail
{
    protected $emailService;

    /**
     * Create the event listener.
     */
    public function __construct(EmailNotificationService $emailService)
    {
        $this->emailService = $emailService;
    }

    /**
     * Handle the event.
     */
    public function handle(ChallengeJoined $event): void
    {
        try {
            Log::info('Processing ChallengeJoined event for user: ' . $event->user->email . ', challenge: ' . $event->challenge->title);

            // Check if user has preferences
            if (!$event->user->preferences) {
                Log::warning('User has no preferences record, creating default preferences for user: ' . $event->user->email);

                // Create default preferences if missing
                $event->user->preferences()->create([
                    'notification_preferences' => [
                        'quiz_reminders' => true,
                        'challenge_updates' => true,
                        'achievement_alerts' => true,
                        'weekly_summaries' => true,
                        'marketing_emails' => false,
                        'email_frequency' => 'weekly'
                    ],
                    'privacy_settings' => [
                        'profile_visibility' => 'private',
                        'share_achievements' => false,
                        'share_progress' => false
                    ],
                    'data_processing_consents' => [
                        'analytics' => false,
                        'personalization' => false,
                        'third_party_sharing' => false
                    ]
                ]);

                // Reload user with preferences
                $event->user->refresh();
            }

            // Send notification
            $result = $this->emailService->sendChallengeJoinedNotification($event->user, $event->challenge);

            // No necesitamos registrar aquí el resultado, ya que EmailNotificationService ya lo hace
            // y podría estar contribuyendo a la duplicación de logs
        } catch (\Exception $e) {
            Log::error('Failed to send challenge joined email to user: ' . $event->user->email . ' - ' . $e->getMessage());
            Log::error('Exception trace: ' . $e->getTraceAsString());
        }
    }
}
