<?php

namespace App\Listeners;

use App\Events\DailyTip;
use App\Services\EmailNotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendDailyTipEmail implements ShouldQueue
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
    public function handle(DailyTip $event): void
    {
        try {
            $result = $this->emailService->sendDailyTipEmail(
                $event->user,
                $event->tip_category,
                $event->tip_title,
                $event->tip_content,
                $event->action_steps
            );

            if ($result) {
                Log::info('Daily tip email sent to user: ' . $event->user->email);
                // Actualizar la fecha del último email enviado
                $event->user->update(['last_email_sent_at' => now()]);
            } else {
                Log::warning('Daily tip email not sent to user: ' . $event->user->email . ' - possibly due to user preferences');
            }
        } catch (\Exception $e) {
            Log::error('Failed to send daily tip email to user: ' . $event->user->email . ' - ' . $e->getMessage());
        }
    }
}
