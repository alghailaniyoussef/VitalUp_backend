<?php

namespace Database\Factories;

use App\Models\Challenge;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChallengeFactory extends Factory
{
    protected $model = Challenge::class;

    public function definition(): array
    {
        $categories = ['fitness', 'nutrition', 'mental_health', 'sleep', 'wellness'];
        $difficulties = ['beginner', 'intermediate', 'advanced'];
        $durationDays = $this->faker->randomElement([7, 14, 21, 30]);

        // Generate 2-4 goals for the challenge
        $goals = [];
        $goalCount = $this->faker->numberBetween(2, 4);

        for ($i = 0; $i < $goalCount; $i++) {
            $goals[] = [
                'description' => $this->faker->sentence(),
                'target' => $this->faker->numberBetween(1, 10),
                'unit' => $this->faker->randomElement(['times', 'hours', 'days', 'points'])
            ];
        }

        // Generate 0-2 badge rewards
        $badgeRewards = [];
        $badgeCount = $this->faker->numberBetween(0, 2);

        for ($i = 1; $i <= $badgeCount; $i++) {
            $badgeRewards[] = $i; // Badge IDs will be 1-10 after seeding
        }

        // Determine if challenge has date constraints
        $hasDateConstraints = $this->faker->boolean(30); // 30% chance
        $startDate = $hasDateConstraints ? $this->faker->dateTimeBetween('-10 days', '+10 days') : null;
        $endDate = $startDate ? $this->faker->dateTimeBetween($startDate, '+' . ($durationDays + 30) . ' days') : null;

        return [
            'title' => $this->faker->unique()->words(3, true),
            'description' => $this->faker->paragraph(),
            'category' => $this->faker->randomElement($categories),
            'difficulty' => $this->faker->randomElement($difficulties),
            'goals' => $goals,
            'duration_days' => $durationDays,
            'points_reward' => $this->faker->numberBetween(50, 500),
            'badge_rewards' => $badgeRewards,
            'is_active' => $this->faker->boolean(80), // 80% chance of being active
            'start_date' => $startDate,
            'end_date' => $endDate,
        ];
    }
}
