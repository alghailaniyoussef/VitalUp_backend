<?php

namespace Database\Factories;

use App\Models\Badge;
use Illuminate\Database\Eloquent\Factories\Factory;

class BadgeFactory extends Factory
{
    protected $model = Badge::class;

    public function definition(): array
    {
        $types = ['quiz', 'challenge', 'points', 'level'];
        $type = $this->faker->randomElement($types);

        $requirements = [];

        switch ($type) {
            case 'quiz':
                $requirements = [
                    'min_score' => $this->faker->numberBetween(70, 100),
                    'quiz_count' => $this->faker->numberBetween(1, 5)
                ];
                break;
            case 'challenge':
                $requirements = [
                    'challenge_count' => $this->faker->numberBetween(1, 5)
                ];
                break;
            case 'points':
                $requirements = [
                    'points_required' => $this->faker->numberBetween(100, 1000)
                ];
                break;
            case 'level':
                $requirements = [
                    'level_required' => $this->faker->numberBetween(1, 10)
                ];
                break;
        }

        return [
            'name' => $this->faker->unique()->words(3, true),
            'description' => $this->faker->sentence(),
            'icon_path' => 'icons/badges/' . $this->faker->word() . '.svg',
            'type' => $type,
            'requirements' => $requirements,
            'points_reward' => $this->faker->numberBetween(10, 100),
            'is_active' => $this->faker->boolean(90), // 90% chance of being active
        ];
    }
}
