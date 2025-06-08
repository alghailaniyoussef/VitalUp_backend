<?php

namespace Database\Factories;

use App\Models\Quiz;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuizFactory extends Factory
{
    protected $model = Quiz::class;

    public function definition(): array
    {
        // Generate 5-10 questions for the quiz
        $questions = [];
        $questionCount = $this->faker->numberBetween(5, 10);

        for ($i = 0; $i < $questionCount; $i++) {
            $options = [
                $this->faker->sentence(4),
                $this->faker->sentence(4),
                $this->faker->sentence(4),
                $this->faker->sentence(4)
            ];

            $questions[] = [
                'question' => $this->faker->sentence() . '?',
                'options' => $options,
                'correct_answer' => $this->faker->numberBetween(0, 3) // Index of correct option
            ];
        }

        // Determine if quiz has availability constraints
        $hasAvailabilityConstraints = $this->faker->boolean(40); // 40% chance
        $availableFrom = $hasAvailabilityConstraints ? $this->faker->dateTimeBetween('-10 days', '+10 days') : null;
        $availableUntil = $availableFrom ? $this->faker->dateTimeBetween($availableFrom, '+30 days') : null;

        return [
            'title' => $this->faker->unique()->words(3, true),
            'description' => $this->faker->paragraph(),
            'questions' => $questions,
            'points_per_question' => $this->faker->randomElement([5, 10, 15, 20]),
            'is_active' => $this->faker->boolean(80), // 80% chance of being active
            'available_from' => $availableFrom,
            'available_until' => $availableUntil,
        ];
    }
}
