<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserBadge extends Pivot
{
    use HasFactory;

    protected $table = 'user_badges';

    protected $fillable = [
        'user_id',
        'badge_id',
        'earned_at'
    ];

    protected $casts = [
        'earned_at' => 'datetime'
    ];

    public function notifyUser(): void
    {
        $user = User::find($this->user_id);
        $badge = Badge::find($this->badge_id);

        // Here we can implement notification logic
        // For example, sending an email or push notification
        // about earning the badge
    }
}
