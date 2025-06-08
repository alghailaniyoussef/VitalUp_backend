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
        Schema::create('challenges', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->enum('category', ['fitness', 'nutrition', 'mental_health', 'sleep', 'wellness', 'physical', 'mental', 'social', 'environmental']);
            $table->enum('difficulty', ['beginner', 'intermediate', 'advanced']);
            $table->json('goals')->nullable();; // Daily/weekly goals or milestones
            $table->unsignedInteger('duration_days');
            $table->unsignedInteger('points_reward');
            $table->json('badge_rewards')->nullable(); // IDs of badges that can be earned
            $table->boolean('is_active')->default(true);
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->timestamps();
        });

        Schema::create('user_challenges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('challenge_id')->constrained()->onDelete('cascade');
            $table->json('progress'); // Track daily/weekly progress
            $table->enum('status', ['active', 'completed', 'abandoned'])->default('active');
            $table->timestamp('started_at');
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            // A user can only participate in a challenge once at a time
            $table->unique(['user_id', 'challenge_id', 'started_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_challenges');
        Schema::dropIfExists('challenges');
    }
};
