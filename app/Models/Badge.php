<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Badge extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'icon_path',
        'type',
        'requirements',
        'points_reward',
        'locale'
    ];

    protected $casts = [
        'requirements' => 'array'
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_badges')
            ->withTimestamp('earned_at')
            ->withTimestamps();
    }

    public function checkRequirements(User $user): bool
    {
        switch ($this->type) {
            case 'quiz':
                return $this->checkQuizRequirements($user);
            case 'challenge':
                return $this->checkChallengeRequirements($user);
            case 'points':
                return $this->checkPointsRequirements($user);
            case 'level':
                return $this->checkLevelRequirements($user);
            default:
                return false;
        }
    }

    protected function checkQuizRequirements(User $user): bool
    {
        $requirements = $this->requirements;
        $quizAttempts = $user->quizAttempts();

        if (isset($requirements['min_score'])) {
            $passedQuizzes = $quizAttempts->where('score', '>=', $requirements['min_score'])->count();
            return $passedQuizzes >= ($requirements['quiz_count'] ?? 1);
        }

        return false;
    }

    protected function checkChallengeRequirements(User $user): bool
    {
        $requirements = $this->requirements;
        $completedChallenges = $user->challenges()->where('status', 'completed');

        if (isset($requirements['challenge_count'])) {
            return $completedChallenges->count() >= $requirements['challenge_count'];
        }

        if (isset($requirements['specific_challenges'])) {
            return $completedChallenges->whereIn('challenge_id', $requirements['specific_challenges'])
                ->count() === count($requirements['specific_challenges']);
        }

        return false;
    }

    protected function checkPointsRequirements(User $user): bool
    {
        return isset($this->requirements['points_required']) &&
            $user->points >= $this->requirements['points_required'];
    }

    protected function checkLevelRequirements(User $user): bool
    {
        return isset($this->requirements['level_required']) &&
            $user->level >= $this->requirements['level_required'];
    }
}
