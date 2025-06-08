<?php

namespace App\Listeners;

use App\Events\QuizCompleted;
use App\Services\EmailNotificationService;
use App\Http\Controllers\BadgeController;
use Illuminate\Support\Facades\Log;

class SendQuizCompletedEmail
{
    protected $emailService;
    protected $badgeController;

    /**
     * Create the event listener.
     */
    public function __construct(EmailNotificationService $emailService, BadgeController $badgeController)
    {
        $this->emailService = $emailService;
        $this->badgeController = $badgeController;
    }

    /**
     * Handle the event.
     */
    public function __invoke(QuizCompleted $event): void
    {
        $this->handle($event);
    }

    /**
     * Handle the event.
     */
    public function handle(QuizCompleted $event): void
    {
        try {
            Log::info('Processing QuizCompleted event for user: ' . $event->user->email . ', quiz: ' . $event->quiz->title);

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
            $this->emailService->sendQuizCompletedNotification(
                $event->user,
                $event->quiz,
                $event->score,
                $event->totalQuestions,
                $event->pointsEarned
            );

            // Check and award badges after quiz completion
            $this->badgeController->checkAndAwardBadges($event->user);
            Log::info('Badge check completed for user after quiz completion: ' . $event->user->email);

        } catch (\Exception $e) {
            Log::error('Failed to send quiz completed email to user: ' . $event->user->email . ' - ' . $e->getMessage());
            Log::error('Exception trace: ' . $e->getTraceAsString());
        }
    }
}
