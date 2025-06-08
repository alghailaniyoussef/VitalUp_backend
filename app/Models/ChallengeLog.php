<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChallengeLog extends Model
{
    protected $fillable = ['user_id', 'challenge', 'category', 'completed_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
