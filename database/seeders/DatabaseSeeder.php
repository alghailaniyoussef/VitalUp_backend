<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call seeders in the correct order to handle dependencies
        $this->call([
            // First seed users
            UserSeeder::class,

            // Then seed badges, challenges, and quizzes in both languages
            BadgeSeeder::class,
            BadgeSeederEs::class,
            ChallengeSeeder::class,
            ChallengeSeederEs::class,
            QuizSeeder::class,
            QuizSeederEs::class,

            // Seed tips in both languages
            TipSeeder::class,
            TipSeederEs::class,

            // Finally seed the relationship tables
            UserBadgeSeeder::class,
            UserChallengeSeeder::class,
            QuizAttemptSeeder::class,
        ]);
    }
}
