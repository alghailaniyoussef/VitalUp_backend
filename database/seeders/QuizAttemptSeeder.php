<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use Illuminate\Database\Seeder;

class QuizAttemptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all users and quizzes
        $users = User::all();
        $quizzes = Quiz::all();

        // For each user, create 1-5 quiz attempts
        foreach ($users as $user) {
            // Skip the first user (admin) to create a specific quiz attempt pattern
            if ($user->id === 1) {
                // Admin has attempted all quizzes with high scores
                foreach ($quizzes as $quiz) {
                    $this->createQuizAttempt($user, $quiz, 90, 100);
                }
                continue;
            }

            // For regular users, create quiz attempts based on their level
            $attemptCount = min(ceil($user->level / 2), 5); // Higher level users have more attempts
            $randomQuizzes = $quizzes->random(max(1, $attemptCount));

            foreach ($randomQuizzes as $quiz) {
                // Higher level users tend to have better scores
                $minScore = max(50, $user->level * 8);
                $maxScore = min(100, $minScore + 30);

                $this->createQuizAttempt($user, $quiz, $minScore, $maxScore);
            }
        }
    }

    /**
     * Create a quiz attempt with a score in the given range.
     *
     * @param User $user The user taking the quiz
     * @param Quiz $quiz The quiz being attempted
     * @param int $minScore Minimum score percentage
     * @param int $maxScore Maximum score percentage
     * @return QuizAttempt
     */
    private function createQuizAttempt(User $user, Quiz $quiz, int $minScore, int $maxScore): QuizAttempt
    {
        $questions = json_decode($quiz->questions, true) ?? [];
        $totalQuestions = count($questions);

        // Calculate how many questions to answer correctly based on desired score range
        $targetScore = rand($minScore, $maxScore);
        $correctCount = round(($targetScore / 100) * $totalQuestions);

        // Generate answers array
        $answers = [];
        for ($i = 0; $i < $totalQuestions; $i++) {
            if ($i < $correctCount) {
                // Answer correctly
                $answers[$i] = $questions[$i]['correct_answer'];
            } else {
                // Answer incorrectly
                $correctAnswer = $questions[$i]['correct_answer'];
                $incorrectOptions = array_diff([0, 1, 2, 3], [$correctAnswer]);
                $answers[$i] = $incorrectOptions[array_rand($incorrectOptions)];
            }
        }

        // Shuffle answers to randomize which questions are answered correctly
        shuffle($answers);

        // Recalculate actual score based on shuffled answers
        $actualCorrectCount = 0;
        foreach ($answers as $index => $answer) {
            if ($answer === $questions[$index]['correct_answer']) {
                $actualCorrectCount++;
            }
        }

        $score = ($actualCorrectCount / $totalQuestions) * 100;
        $pointsEarned = $actualCorrectCount * $quiz->points_per_question;

        // Create and return the quiz attempt
        return QuizAttempt::create([
            'user_id' => $user->id,
            'quiz_id' => $quiz->id,
            'answers' => $answers,
            'score' => $score,
            'points_earned' => $pointsEarned,
            'completed_at' => now()->subDays(rand(1, 30)),
        ]);
    }
}
