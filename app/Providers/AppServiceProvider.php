<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\UserRegistered;
use App\Events\ChallengeCompleted;
use App\Events\ChallengeJoined;
use App\Events\QuizCompleted;
use App\Events\BadgeEarned;
use App\Events\LevelUp;
use App\Events\DailyTip;
use App\Listeners\SendWelcomeEmail;
use App\Listeners\SendChallengeCompletedEmail;
use App\Listeners\SendChallengeJoinedEmail;
use App\Listeners\SendQuizCompletedEmail;
use App\Listeners\SendBadgeEarnedEmail;
use App\Listeners\SendLevelUpEmail;
use App\Listeners\SendDailyTipEmail;
use App\Listeners\CheckBadgeEligibility;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register event listeners
        Event::listen(
            UserRegistered::class,
            SendWelcomeEmail::class
        );

        Event::listen(
            ChallengeCompleted::class,
            SendChallengeCompletedEmail::class
        );

        Event::listen(
            ChallengeJoined::class,
            SendChallengeJoinedEmail::class
        );

        Event::listen(QuizCompleted::class, SendQuizCompletedEmail::class);
        Event::listen(QuizCompleted::class, CheckBadgeEligibility::class);

        Event::listen(
            BadgeEarned::class,
            SendBadgeEarnedEmail::class
        );

        Event::listen(
            LevelUp::class,
            SendLevelUpEmail::class
        );

        Event::listen(
            DailyTip::class,
            SendDailyTipEmail::class
        );
    }
}
