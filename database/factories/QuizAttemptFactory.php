<?php

namespace Database\Factories;

use App\Models\Quiz;
use App\Models\User;
use App\Models\QuizAttempt;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuizAttemptFactory extends Factory
{
    protected $model = QuizAttempt::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'quiz_id' => Quiz::factory(),
            'answers' => [], // Will be populated in the configure method
            'score' => 0, // Will be calculated in the configure method
            'points_earned' => 0, // Will be calculated in the configure method
            'completed_at' => $this->faker->dateTimeBetween('-30 days', 'now'),
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterMaking(function (QuizAttempt $quizAttempt) {
            // If quiz_id is already set and the quiz exists, use it
            if ($quizAttempt->quiz_id && $quiz = Quiz::find($quizAttempt->quiz_id)) {
                $questions = $quiz->questions;
                $answers = [];
                $correctCount = 0;

                foreach ($questions as $index => $question) {
                    // 70% chance of getting the answer correct
                    $isCorrect = $this->faker->boolean(70);
                    $answers[$index] = $isCorrect ? $question['correct_answer'] : $this->faker->numberBetween(0, 3);

                    if ($isCorrect) {
                        $correctCount++;
                    }
                }

                $quizAttempt->answers = $answers;
                $quizAttempt->score = count($questions) > 0 ? ($correctCount / count($questions)) * 100 : 0;
                $quizAttempt->points_earned = $correctCount * $quiz->points_per_question;
            }
        });
    }
}
