<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserPreference extends Model
{
    protected $fillable = [
        'user_id',
        'notification_preferences',
        'privacy_settings',
        'data_processing_consents',
        'last_consent_update'
    ];

    protected $casts = [
        'notification_preferences' => 'array',
        'privacy_settings' => 'array',
        'data_processing_consents' => 'array',
        'last_consent_update' => 'datetime'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
