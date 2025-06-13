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
            UserSeeder::class,
            BadgeSeeder::class,
            BadgeSeederEs::class,
            BadgeSeederAr::class,
            ChallengeSeeder::class,
            ChallengeSeederEs::class,
            ChallengeSeederAr::class,
            QuizSeeder::class,
            QuizSeederEs::class,
            QuizSeederAr::class,
            QuizSeederEsAdditional::class,
            QuizSeederEnAdditional::class,
            TipSeeder::class,
            TipSeederEs::class,
            UserChallengeSeeder::class,
            QuizAttemptSeeder::class,
            UserBadgeSeeder::class,
        ]);
    }
}
