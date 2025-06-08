<?php

namespace App\Listeners;

use App\Events\LevelUp;
use App\Services\EmailNotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendLevelUpEmail implements ShouldQueue
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
    public function handle(LevelUp $event): void
    {
        try {
            $this->emailService->sendLevelUpNotification(
                $event->user,
                $event->new_level,
                $event->next_level_points
            );
            Log::info('Level up email sent to user: ' . $event->user->email);
        } catch (\Exception $e) {
            Log::error('Failed to send level up email to user: ' . $event->user->email . ' - ' . $e->getMessage());
        }
    }
}
