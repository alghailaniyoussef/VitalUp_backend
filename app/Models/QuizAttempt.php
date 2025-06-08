<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QuizAttempt extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'quiz_id',
        'answers',
        'score',
        'points_earned',
        'completed_at'
    ];

    protected $casts = [
        'answers' => 'array',
        'completed_at' => 'datetime'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class);
    }

    public function calculateScore(): void
    {
        $questions = $this->quiz->questions;
        $answers = $this->answers;
        $totalQuestions = count($questions);
        $correctAnswers = 0;

        foreach ($questions as $index => $question) {
            if (isset($answers[$index]) && $answers[$index] === $question['correct_answer']) {
                $correctAnswers++;
            }
        }

        $this->score = ($correctAnswers / $totalQuestions) * 100;
        $this->points_earned = $correctAnswers * $this->quiz->points_per_question;
    }
}
