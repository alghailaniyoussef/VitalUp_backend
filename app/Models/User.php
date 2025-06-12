<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'email_frequency',
        'locale',
        'interests',
        'points',
        'level',
        'last_email_sent_at',
        'last_login_at',
        'is_admin'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'interests' => 'array',
        'completed_challenges' => 'array',
        'points' => 'integer',
        'level' => 'integer',
        'last_email_sent_at' => 'datetime',
        'last_login_at' => 'datetime',
        'is_admin' => 'boolean'
    ];

    /**
     * Boot method to handle model events
     */
    protected static function boot()
    {
        parent::boot();
        // UserRegistered event is now fired manually in controllers for better control
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'interests' => 'array',
            'last_email_sent_at' => 'datetime',
        ];
    }

    public function quizAttempts()
    {
        return $this->hasMany(QuizAttempt::class);
    }

    public function badges()
    {
        return $this->belongsToMany(Badge::class, 'user_badges')
            ->withPivot(['earned_at'])
            ->using(UserBadge::class)
            ->withTimestamps();
    }

    public function challenges()
    {
        return $this->belongsToMany(Challenge::class, 'user_challenges')
            ->withPivot(['progress', 'status', 'started_at', 'completed_at'])
            ->using(UserChallenge::class)
            ->withTimestamps()
            ->distinct();
    }

    public function completedChallenges()
    {
        return $this->belongsToMany(Challenge::class, 'user_challenges')
            ->wherePivot('status', 'completed')
            ->withPivot(['progress', 'status', 'started_at', 'completed_at'])
            ->using(UserChallenge::class)
            ->withTimestamps()
            ->distinct();
    }

    public function challengeLogs()
    {
        return $this->hasMany(ChallengeLog::class);
    }

    public function emailLogs()
    {
        return $this->hasMany(EmailLog::class);
    }

    public function preferences()
    {
        return $this->hasOne(UserPreference::class);
    }

    public function pointsHistory(): HasMany
    {
        return $this->hasMany(UserPointsHistory::class)->orderBy('created_at', 'desc');
    }

    public function calculateLevel()
    {
        $points = $this->points ?? 0;
        return max(1, (int) ($points / 100) + 1);
    }

    /**
     * Verificar si el usuario ha subido de nivel
     */
    public function hasLeveledUp(int $oldPoints): bool
    {
        $oldLevel = max(1, (int) ($oldPoints / 100) + 1);
        $newLevel = $this->calculateLevel();

        return $newLevel > $oldLevel;
    }

    /**
     * Obtener los puntos necesarios para el siguiente nivel
     */
    public function getPointsForNextLevel(): int
    {
        return $this->calculateLevel() * 100;
    }

    /**
     * Obtener el progreso hacia el siguiente nivel (porcentaje)
     */
    public function getLevelProgressPercentage(): int
    {
        $currentLevel = $this->calculateLevel();
        $currentLevelMinPoints = ($currentLevel - 1) * 100;
        $nextLevelMinPoints = $currentLevel * 100;
        $pointsInCurrentLevel = $this->points - $currentLevelMinPoints;
        $pointsRequiredForNextLevel = $nextLevelMinPoints - $currentLevelMinPoints;

        return min(100, (int) ($pointsInCurrentLevel * 100 / $pointsRequiredForNextLevel));
    }
}
