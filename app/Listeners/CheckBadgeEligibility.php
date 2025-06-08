<?php

namespace App\Listeners;

use App\Events\QuizCompleted;
use App\Http\Controllers\BadgeController;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CheckBadgeEligibility
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
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
        $badgeController = new BadgeController();
        $badgeController->checkAndAwardBadges($event->user);
    }
}
