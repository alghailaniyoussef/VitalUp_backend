<?php

namespace App\Listeners;

use App\Events\ChallengeCompleted;
use App\Services\EmailNotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendChallengeCompletedEmail implements ShouldQueue
{
    use InteractsWithQueue;

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
    public function handle(ChallengeCompleted $event): void
    {
        try {
            $this->emailService->sendChallengeCompletedNotification(
                $event->user,
                $event->challenge
            );
            Log::info('Challenge completed email sent to user: ' . $event->user->email);
        } catch (\Exception $e) {
            Log::error('Failed to send challenge completed email to user: ' . $event->user->email . ' - ' . $e->getMessage());
        }
    }
}
