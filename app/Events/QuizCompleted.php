<?php

namespace App\Events;

use App\Models\User;
use App\Models\Quiz;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class QuizCompleted
{
    use Dispatchable, SerializesModels;

    public $user;
    public $quiz;
    public $score;
    public $totalQuestions;
    public $pointsEarned;

    /**
     * Create a new event instance.
     */
    public function __construct(User $user, Quiz $quiz, int $score, int $totalQuestions, int $pointsEarned)
    {
        $this->user = $user;
        $this->quiz = $quiz;
        $this->score = $score;
        $this->totalQuestions = $totalQuestions;
        $this->pointsEarned = $pointsEarned;
    }
}
