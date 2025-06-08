<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Services\EmailNotificationService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SendDailyTips extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send-daily-tips';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send daily tips to users based on their email frequency preferences';

    protected $emailService;

    /**
     * Create a new command instance.
     */
    public function __construct(EmailNotificationService $emailService)
    {
        parent::__construct();
        $this->emailService = $emailService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting daily tips email sending...');

        // Get all users with email preferences
        $users = User::whereIn('email_frequency', ['daily', 'every_3_days', 'weekly'])
                    ->whereNotNull('email_verified_at')
                    ->get();

        $sentCount = 0;
        $skippedCount = 0;
        $errorCount = 0;

        foreach ($users as $user) {
            try {
                $result = $this->emailService->sendDailyTip($user);

                if ($result) {
                    $sentCount++;
                    $this->info("Daily tip sent to: {$user->email}");
                } else {
                    $skippedCount++;
                    $this->line("Skipped (not time yet): {$user->email}");
                }
            } catch (\Exception $e) {
                $errorCount++;
                $this->error("Failed to send to {$user->email}: {$e->getMessage()}");
                Log::error("Daily tip sending failed for user {$user->id}: {$e->getMessage()}");
            }
        }

        $this->info("\nDaily tips sending completed!");
        $this->info("Sent: {$sentCount}");
        $this->info("Skipped: {$skippedCount}");
        $this->info("Errors: {$errorCount}");

        Log::info("Daily tips command completed. Sent: {$sentCount}, Skipped: {$skippedCount}, Errors: {$errorCount}");

        return 0;
    }
}
