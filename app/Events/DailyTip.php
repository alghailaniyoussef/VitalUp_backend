<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DailyTip
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $tip_category;
    public $tip_title;
    public $tip_content;
    public $action_steps;

    /**
     * Create a new event instance.
     */
    public function __construct(User $user, string $tip_category, string $tip_title, string $tip_content, array $action_steps)
    {
        $this->user = $user;
        $this->tip_category = $tip_category;
        $this->tip_title = $tip_title;
        $this->tip_content = $tip_content;
        $this->action_steps = $action_steps;
    }
}
