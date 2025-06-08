<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LevelUp
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $new_level;
    public $next_level_points;

    /**
     * Create a new event instance.
     */
    public function __construct(User $user, int $new_level, int $next_level_points)
    {
        $this->user = $user;
        $this->new_level = $new_level;
        $this->next_level_points = $next_level_points;
    }
}
