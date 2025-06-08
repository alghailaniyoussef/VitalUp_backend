<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use App\Models\User;
use App\Services\TranslationService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Exception;

class BadgeController extends Controller
{
    /**
     * Obtener todas las insignias disponibles y las ganadas por el usuario
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $user = Auth::user();
            $locale = $request->header('Accept-Language', 'en');

            if (!$user) {
                return response()->json([
                    'error' => 'User not authenticated'
                ], 401);
            }

            // Helper function to add translations to badge
            $addTranslations = function ($badge) use ($locale) {
                // Add translated type if available
                if ($badge->type) {
                    $badge->type_translated = TranslationService::translate('badge_type', $badge->type, $locale);
                }
                return $badge;
            };

            // Obtener las insignias ganadas por el usuario (filtradas por locale)
            $earnedBadges = $user->badges()->where('locale', $locale)->get()->map($addTranslations);

            // Obtener todas las insignias disponibles que el usuario no ha ganado aún
            $availableBadges = Badge::whereNotIn('id', $earnedBadges->pluck('id'))
                ->where('is_active', true)
                ->where('locale', $locale)
                ->get()
                ->map(function ($badge) use ($user, $addTranslations) {
                    // Calcular el progreso para cada insignia
                    try {
                        $badge->progress = $this->calculateBadgeProgress($badge, $user);
                    } catch (Exception $e) {
                        Log::error('Error calculating badge progress: ' . $e->getMessage(), [
                            'badge_id' => $badge->id,
                            'user_id' => $user->id,
                            'trace' => $e->getTraceAsString()
                        ]);
                        $badge->progress = 0;
                    }
                    return $addTranslations($badge);
                });

            return response()->json([
                'earned_badges' => $earnedBadges,
                'available_badges' => $availableBadges
            ]);

        } catch (Exception $e) {
            Log::error('BadgeController index error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'error' => 'Failed to fetch badges',
                'message' => config('app.debug') ? $e->getMessage() : 'Internal server error'
            ], 500);
        }
    }

    /**
     * Calcular el progreso del usuario hacia la obtención de una insignia
     */
    private function calculateBadgeProgress(Badge $badge, User $user): int
    {
        try {
            // Verificar que los requirements sean válidos
            if (empty($badge->requirements)) {
                return 0;
            }

            // Asegurar que requirements es un array
            $requirements = is_array($badge->requirements)
                ? $badge->requirements
                : json_decode($badge->requirements, true);

            if (!$requirements) {
                return 0;
            }

            // Implementación del cálculo de progreso según el tipo de insignia
            switch ($badge->type) {
                case 'quiz':
                    return $this->calculateQuizProgress($requirements, $user);
                case 'challenge':
                    return $this->calculateChallengeProgress($requirements, $user);
                case 'points':
                    return $this->calculatePointsProgress($requirements, $user);
                case 'level':
                    return $this->calculateLevelProgress($requirements, $user);
                default:
                    return 0;
            }
        } catch (Exception $e) {
            Log::error('Error in calculateBadgeProgress: ' . $e->getMessage(), [
                'badge_id' => $badge->id,
                'badge_type' => $badge->type,
                'user_id' => $user->id
            ]);
            return 0;
        }
    }

    /**
     * Calcular el progreso en insignias basadas en cuestionarios
     */
    private function calculateQuizProgress(array $requirements, User $user): int
    {
        try {
            if (!isset($requirements['quiz_count'])) {
                return 0;
            }

            $requiredCount = (int) $requirements['quiz_count'];
            $minScore = $requirements['min_score'] ?? 70;

            // Verificar si existe la relación quizAttempts
            if (!method_exists($user, 'quizAttempts')) {
                Log::warning('quizAttempts relationship not found on User model');
                return 0;
            }

            // For Perfect Score badge (min_score = 100), check if score equals total questions
            if ($minScore == 100) {
                $completedCount = $user->quizAttempts()
                    ->whereRaw('score = (SELECT JSON_LENGTH(questions) FROM quizzes WHERE quizzes.id = quiz_attempts.quiz_id)')
                    ->whereNotNull('completed_at')
                    ->count();
            } else {
                // For other badges, calculate percentage
                $completedCount = $user->quizAttempts()
                    ->whereRaw('(score * 100 / (SELECT JSON_LENGTH(questions) FROM quizzes WHERE quizzes.id = quiz_attempts.quiz_id)) >= ?', [$minScore])
                    ->whereNotNull('completed_at')
                    ->count();
            }

            return $requiredCount > 0 ? min(100, (int) ($completedCount * 100 / $requiredCount)) : 0;

        } catch (Exception $e) {
            Log::error('Error in calculateQuizProgress: ' . $e->getMessage());
            return 0;
        }
    }

    /**
     * Calcular el progreso en insignias basadas en retos
     */
    private function calculateChallengeProgress(array $requirements, User $user): int
    {
        try {
            if (!isset($requirements['challenge_count'])) {
                return 0;
            }

            $requiredCount = (int) $requirements['challenge_count'];

            // Alternativas para obtener el conteo de retos completados
            $completedCount = 0;


            if ($completedCount === 0 && method_exists($user, 'challenges')) {
                try {
                    $completedCount = $user->challenges()
                        ->wherePivot('status', 'completed')
                        ->distinct()
                        ->count();
                } catch (Exception $e) {
                    Log::warning('Error accessing challenges relationship: ' . $e->getMessage());
                }
            }



            return $requiredCount > 0 ? min(100, (int) ($completedCount * 100 / $requiredCount)) : 0;

        } catch (Exception $e) {
            Log::error('Error in calculateChallengeProgress: ' . $e->getMessage());
            return 0;
        }
    }

    /**
     * Calcular el progreso en insignias basadas en puntos
     */
    private function calculatePointsProgress(array $requirements, User $user): int
    {
        try {
            if (!isset($requirements['points_required'])) {
                return 0;
            }

            $requiredPoints = (int) $requirements['points_required'];
            $userPoints = $user->points ?? 0;

            return $requiredPoints > 0 ? min(100, (int) ($userPoints * 100 / $requiredPoints)) : 0;

        } catch (Exception $e) {
            Log::error('Error in calculatePointsProgress: ' . $e->getMessage());
            return 0;
        }
    }

    /**
     * Calcular el progreso en insignias basadas en nivel
     */
    private function calculateLevelProgress(array $requirements, User $user): int
    {
        try {
            if (!isset($requirements['level_required'])) {
                return 0;
            }

            $requiredLevel = (int) $requirements['level_required'];
            $userLevel = $user->level ?? 1;

            return $requiredLevel > 0 ? min(100, (int) ($userLevel * 100 / $requiredLevel)) : 100;

        } catch (Exception $e) {
            Log::error('Error in calculateLevelProgress: ' . $e->getMessage());
            return 0;
        }
    }

    /**
     * Verificar y otorgar insignias automáticamente al usuario
     */
    public function checkAndAwardBadges(User $user): void
    {
        try {
            $availableBadges = Badge::whereNotIn('id', $user->badges->pluck('id'))
                ->where('is_active', true)
                ->get();

            foreach ($availableBadges as $badge) {
                try {
                    // Check if user already has this badge to prevent duplicates
                    if ($user->badges()->where('badge_id', $badge->id)->exists()) {
                        continue; // Skip if user already has this badge
                    }

                    if ($this->checkBadgeRequirements($badge, $user)) {
                        // Otorgar la insignia al usuario
                        $user->badges()->attach($badge->id, ['earned_at' => now()]);

                        // Incrementar el contador de veces otorgada
                        $badge->increment('times_awarded');

                        // Otorgar puntos de recompensa al usuario
                        if ($badge->points_reward > 0) {
                            // Store old points for level comparison
                            $oldPoints = $user->points;

                            $user->increment('points', $badge->points_reward);

                            // Refresh user model to get updated points
                            $user->refresh();

                            // Calculate and update level
                            $newLevel = $user->calculateLevel();
                            $user->level = $newLevel;
                            $user->save();

                            // Check if user leveled up and send notification
                            if ($user->hasLeveledUp($oldPoints)) {
                                $nextLevelPoints = $user->getPointsForNextLevel();
                                app(\App\Services\EmailNotificationService::class)->sendLevelUpNotification($user, $newLevel, $nextLevelPoints);
                            }

                            // Create points history entry
                            \App\Models\UserPointsHistory::createEntry(
                                $user->id,
                                $badge->points_reward,
                                'badge',
                                $badge->id,
                                "Earned badge: {$badge->name}"
                            );
                        }

                        Log::info('Badge awarded to user', [
                            'badge_id' => $badge->id,
                            'badge_name' => $badge->name,
                            'user_id' => $user->id,
                            'points_awarded' => $badge->points_reward
                        ]);

                        // Send badge earned notification
                        event(new \App\Events\BadgeEarned($user, $badge));
                    }
                } catch (Exception $e) {
                    Log::error('Error checking/awarding badge: ' . $e->getMessage(), [
                        'badge_id' => $badge->id,
                        'user_id' => $user->id
                    ]);
                }
            }
        } catch (Exception $e) {
            Log::error('Error in checkAndAwardBadges: ' . $e->getMessage(), [
                'user_id' => $user->id
            ]);
        }
    }

    /**
     * Verificar si el usuario cumple con los requisitos de una insignia
     */
    private function checkBadgeRequirements(Badge $badge, User $user): bool
    {
        try {
            $progress = $this->calculateBadgeProgress($badge, $user);
            return $progress >= 100;
        } catch (Exception $e) {
            Log::error('Error checking badge requirements: ' . $e->getMessage(), [
                'badge_id' => $badge->id,
                'user_id' => $user->id
            ]);
            return false;
        }
    }

    /**
     * Obtener el progreso de una insignia específica para el usuario actual
     */
    public function getBadgeProgress(Request $request, $badgeId): JsonResponse
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return response()->json(['error' => 'User not authenticated'], 401);
            }

            $badge = Badge::findOrFail($badgeId);

            // Verificar si el usuario ya tiene esta insignia
            if ($user->badges()->where('badge_id', $badgeId)->exists()) {
                return response()->json([
                    'progress' => 100,
                    'earned' => true,
                    'earned_at' => $user->badges()->where('badge_id', $badgeId)->first()->pivot->earned_at
                ]);
            }

            $progress = $this->calculateBadgeProgress($badge, $user);

            return response()->json([
                'progress' => $progress,
                'earned' => false
            ]);

        } catch (Exception $e) {
            Log::error('Error getting badge progress: ' . $e->getMessage());

            return response()->json([
                'error' => 'Failed to get badge progress',
                'message' => config('app.debug') ? $e->getMessage() : 'Internal server error'
            ], 500);
        }
    }
}
