<?php

namespace App\Events;

use App\Models\User;
use App\Models\Challenge;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChallengeJoined
{
    use Dispatchable, SerializesModels;

    public $user;
    public $challenge;

    /**
     * Create a new event instance.
     */
    public function __construct(User $user, Challenge $challenge)
    {
        $this->user = $user;
        $this->challenge = $challenge;
    }
}
