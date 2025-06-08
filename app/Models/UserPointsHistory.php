<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserPointsHistory extends Model
{
    use HasFactory;

    protected $table = 'user_points_history';

    protected $fillable = [
        'user_id',
        'points',
        'source_type',
        'source_id',
        'description',
        'balance_after'
    ];

    protected $casts = [
        'points' => 'integer',
        'source_id' => 'integer',
        'balance_after' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Get the user that owns the points history entry.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the source model (quiz, badge, challenge) based on source_type and source_id
     */
    public function source()
    {
        switch ($this->source_type) {
            case 'quiz':
                return $this->belongsTo(Quiz::class, 'source_id');
            case 'badge':
                return $this->belongsTo(Badge::class, 'source_id');
            case 'challenge':
                return $this->belongsTo(Challenge::class, 'source_id');
            default:
                return null;
        }
    }

    /**
     * Create a points history entry
     */
    public static function createEntry(int $userId, int $points, string $sourceType, ?int $sourceId, string $description): self
    {
        $user = User::find($userId);

        return self::create([
            'user_id' => $userId,
            'points' => $points,
            'source_type' => $sourceType,
            'source_id' => $sourceId,
            'description' => $description,
            'balance_after' => $user->points
        ]);
    }
}
