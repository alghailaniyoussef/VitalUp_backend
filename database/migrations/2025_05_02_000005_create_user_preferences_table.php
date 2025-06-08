<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_preferences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->json('notification_preferences')->default(json_encode([
                'quiz_reminders' => true,
                'challenge_updates' => true,
                'achievement_alerts' => true,
                'weekly_summaries' => true,
                'marketing_emails' => false,
                'email_frequency' => 'weekly' // Options: daily, three_days, weekly
            ]));
            $table->json('privacy_settings')->default(json_encode([
                'profile_visibility' => 'private',
                'share_achievements' => false,
                'share_progress' => false
            ]));
            $table->json('data_processing_consents')->default(json_encode([
                'analytics' => false,
                'personalization' => false,
                'third_party_sharing' => false
            ]));
            $table->timestamp('last_consent_update')->nullable();
            $table->timestamps();

            // Ensure one preference record per user
            $table->unique('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_preferences');
    }
};
