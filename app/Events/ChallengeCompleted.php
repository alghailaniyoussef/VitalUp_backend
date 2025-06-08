<?php

namespace App\Events;

use App\Models\User;
use App\Models\Challenge;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChallengeCompleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $challenge;
    public $pointsEarned;

    /**
     * Create a new event instance.
     */
    public function __construct(User $user, Challenge $challenge, int $pointsEarned)
    {
        $this->user = $user;
        $this->challenge = $challenge;
        $this->pointsEarned = $pointsEarned;
    }
}
