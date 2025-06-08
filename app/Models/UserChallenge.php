<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserChallenge extends Pivot
{
    use HasFactory;

    protected $table = 'user_challenges';

    protected $fillable = [
        'user_id',
        'challenge_id',
        'progress',
        'status',
        'started_at',
        'completed_at'
    ];

    protected $casts = [
        'progress' => 'array',
        'started_at' => 'datetime',
        'completed_at' => 'datetime'
    ];

    public function updateProgress(array $newProgress): void
    {
        $this->progress = array_merge($this->progress ?? [], $newProgress);
        $challenge = Challenge::find($this->challenge_id);

        if ($challenge->checkProgress($this->progress) >= 100) {
            $this->status = 'completed';
            $this->completed_at = now();

            // Award points to the user
            $user = User::find($this->user_id);
            $user->increment('points', $challenge->points_reward);

            // Check and award badges
            if (!empty($challenge->badge_rewards)) {
                foreach ($challenge->getAvailableBadges() as $badge) {
                    if ($badge->checkRequirements($user)) {
                        $user->badges()->attach($badge->id, ['earned_at' => now()]);
                        $user->increment('points', $badge->points_reward);
                    }
                }
            }
        }

        $this->save();
    }

    public function abandon(): void
    {
        $this->status = 'abandoned';
        $this->save();
    }
}
