<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $availableInterests = ['fitness', 'nutrition', 'mental_health', 'sleep', 'wellness'];
        $userInterests = fake()->randomElements($availableInterests, fake()->numberBetween(1, 3));

        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'interests' => $userInterests,
            'points' => fake()->numberBetween(0, 1000),
            'level' => fake()->numberBetween(1, 5),
            'email_frequency' => fake()->randomElement(['daily', 'every_3_days', 'weekly']),
            'last_email_sent_at' => fake()->optional(0.7)->dateTimeBetween('-7 days', 'now')
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
