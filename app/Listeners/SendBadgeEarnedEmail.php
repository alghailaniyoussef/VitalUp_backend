<?php

namespace App\Listeners;

use App\Events\BadgeEarned;
use App\Services\EmailNotificationService;
use Illuminate\Support\Facades\Log;

class SendBadgeEarnedEmail
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
    public function handle(BadgeEarned $event): void
    {
        try {
            $this->emailService->sendBadgeEarnedNotification(
                $event->user,
                $event->badge
            );
            Log::info('Badge earned email sent to user: ' . $event->user->email);
        } catch (\Exception $e) {
            Log::error('Failed to send badge earned email to user: ' . $event->user->email . ' - ' . $e->getMessage());
        }
    }
}
