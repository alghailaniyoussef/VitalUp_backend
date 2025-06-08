<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    /**
     * Obtener el perfil del usuario autenticado
     */
    public function show(): JsonResponse
    {
        $user = Auth::user();

        // Calcular estadísticas del usuario
        $completedChallenges = $user->challenges()
            ->wherePivot('status', 'completed')
            ->distinct()
            ->count();

        $completedQuizzes = $user->quizAttempts()->count();

        $badgesCount = $user->badges()->count();

        // Obtener las insignias más recientes
        $recentBadges = $user->badges()
            ->orderBy('user_badges.created_at', 'desc')
            ->limit(3)
            ->get()
            ->map(function ($badge) {
                return [
                    'id' => $badge->id,
                    'name' => $badge->name,
                    'icon' => $badge->icon_path,
                    'earned_at' => $badge->pivot->earned_at
                ];
            });

        // Calcular días activos (días con actividad registrada)
        $activeDays = $user->challengeLogs()
            ->selectRaw('COUNT(DISTINCT DATE(created_at)) as days')
            ->first()
            ->days;

        // Calcular progreso de nivel
        $levelProgress = $user->getLevelProgressPercentage();
        $pointsToNextLevel = $user->getPointsForNextLevel() - $user->points;

        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'created_at' => $user->created_at,
            'level' => $user->level,
            'points' => $user->points,
            'level_progress' => $levelProgress,
            'points_to_next_level' => $pointsToNextLevel,
            'completed_challenges' => $completedChallenges,
            'completed_quizzes' => $completedQuizzes,
            'badges_count' => $badgesCount,
            'active_days' => $activeDays,
            'recent_badges' => $recentBadges
        ]);
    }

    /**
     * Actualizar el perfil del usuario
     */
    public function update(Request $request): JsonResponse
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:users,email,' . $user->id,
            'interests' => 'sometimes|array'
        ]);

        $user->update($validated);

        return response()->json([
            'message' => 'Perfil actualizado correctamente',
            'user' => $user
        ]);
    }
}
