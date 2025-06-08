<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Services\EmailNotificationService;
use Illuminate\Support\Facades\Log;

class SendWelcomeEmail
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
    public function handle(UserRegistered $event): void
    {
        try {
            $this->emailService->sendWelcomeEmail($event->user);
            Log::info('Welcome email sent to user: ' . $event->user->email);
        } catch (\Exception $e) {
            Log::error('Failed to send welcome email to user: ' . $event->user->email . ' - ' . $e->getMessage());
        }
    }
}
