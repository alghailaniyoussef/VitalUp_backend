<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\EmailLog;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendWelcomeEmails extends Command
{
    protected $signature = 'email:welcome {--test : Send test emails to specific users}';
    protected $description = 'Send welcome emails to users and log the results';

    public function handle()
    {
        // This command is disabled to prevent duplicate welcome emails
        // The welcome emails are already sent by the SendWelcomeEmail listener
        // when a user registers (UserRegistered event)
        $this->info('This command is disabled to prevent duplicate welcome emails.');
        $this->info('Welcome emails are already sent by the SendWelcomeEmail listener.');
        return 0;

        // Original code below (not executed)
        $testEmails = [
            'youssef@growersgo.com',
            'alghailani.youssef@gmail.com',
            'hanane.elouahabi8@gmail.com',
            'miguel.campus11@gmail.com',
            'barraganriverosolomon@gmail.com'
        ];

        $users = User::whereIn('email', $testEmails)->get();

        if ($users->isEmpty()) {
            $this->error('No users found with the specified email addresses.');
            return 1;
        }

        $this->info('Sending welcome emails to ' . $users->count() . ' users...');

        foreach ($users as $user) {
            try {
                // Send email
                Mail::send('emails.welcome', ['user' => $user], function ($message) use ($user) {
                    $message->to($user->email, $user->name)
                           ->subject('¡Bienvenido a VitalUp! 🌱');
                });

                // Log successful send
                EmailLog::create([
                    'user_id' => $user->id,
                    'email_type' => 'welcome',
                    'status' => 'sent',
                    'recipient' => $user->email,
                ]);

                $this->info("✅ Email sent successfully to {$user->email}");

            } catch (\Exception $e) {
                // Log failed send
                EmailLog::create([
                    'user_id' => $user->id,
                    'email_type' => 'welcome',
                    'status' => 'failed',
                    'recipient' => $user->email,
                    'error_message' => $e->getMessage(),
                ]);

                $this->error("❌ Failed to send email to {$user->email}: {$e->getMessage()}");
                Log::error("Failed to send welcome email to {$user->email}", [
                    'error' => $e->getMessage(),
                    'user_id' => $user->id
                ]);
            }
        }

        // Show summary
        $sentCount = EmailLog::where('email_type', 'welcome')
                           ->where('status', 'sent')
                           ->whereDate('created_at', today())
                           ->count();

        $failedCount = EmailLog::where('email_type', 'welcome')
                             ->where('status', 'failed')
                             ->whereDate('created_at', today())
                             ->count();

        $this->info("\n📊 Summary:");
        $this->info("✅ Sent: {$sentCount}");
        $this->info("❌ Failed: {$failedCount}");

        return 0;
    }
}
