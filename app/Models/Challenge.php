<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Challenge extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'category',
        'difficulty',
        'goals',
        'duration_days',
        'points_reward',
        'badge_rewards',
        'is_active',
        'start_date',
        'end_date',
        'locale'
    ];

    protected $casts = [
        'goals' => 'array',
        'badge_rewards' => 'array',
        'is_active' => 'boolean',
        'start_date' => 'datetime',
        'end_date' => 'datetime'
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_challenges')
            ->withPivot(['progress', 'status', 'started_at', 'completed_at'])
            ->withTimestamps();
    }

    public function isAvailable(): bool
    {
        if (!$this->is_active) {
            return false;
        }

        $now = now();

        if ($this->start_date && $now->lt($this->start_date)) {
            return false;
        }

        if ($this->end_date && $now->gt($this->end_date)) {
            return false;
        }

        return true;
    }

    public function checkProgress(array $progress): float
    {
        $totalGoals = count($this->goals);
        $completedGoals = 0;

        foreach ($this->goals as $index => $goal) {
            if (isset($progress[$index]) && $progress[$index] >= $goal['target']) {
                $completedGoals++;
            }
        }

        return ($completedGoals / $totalGoals) * 100;
    }

    public function getAvailableBadges(): array
    {
        if (empty($this->badge_rewards)) {
            return [];
        }

        return Badge::whereIn('id', $this->badge_rewards)->get()->toArray();
    }
}
