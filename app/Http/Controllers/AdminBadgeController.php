<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class AdminBadgeController extends Controller
{
    /**
     * Obtener todas las insignias con paginación
     */
    public function getBadges(Request $request): JsonResponse
    {
        $perPage = $request->input('per_page', 15);
        $locale = $request->input('locale');
        
        $query = Badge::query();
        
        // If no locale specified, fetch all badges
        // If locale specified, filter by that locale
        if ($locale) {
            $query->where('locale', $locale);
        }
        
        $badges = $query->orderBy('created_at', 'desc')->paginate($perPage);
        return response()->json($badges);
    }

    /**
     * Crear una nueva insignia
     */
    public function createBadge(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'icon_path' => 'required|string',
            'type' => 'required|in:quiz,challenge,points,level',
            'requirements' => 'required|array',
            'points_reward' => 'required|integer|min:0',
            'locale' => 'required|string|in:en,es'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $badgeData = $request->all();
        $badgeData['is_active'] = true; // Always create badges as active

        $badge = Badge::create($badgeData);
        return response()->json($badge, 201);
    }

    /**
     * Actualizar una insignia existente
     */
    public function updateBadge(Request $request, $id): JsonResponse
    {
        $badge = Badge::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'icon_path' => 'sometimes|string',
            'type' => 'sometimes|in:quiz,challenge,points,level',
            'requirements' => 'sometimes|array',
            'points_reward' => 'sometimes|integer|min:0',
            'is_active' => 'sometimes|boolean',
            'locale' => 'sometimes|string|in:en,es'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $badge->update($request->all());
        return response()->json($badge);
    }

    /**
     * Eliminar una insignia
     */
    public function deleteBadge($id): JsonResponse
    {
        $badge = Badge::findOrFail($id);
        $badge->delete();

        return response()->json(null, 204);
    }

    /**
     * Obtener estadísticas de insignias
     */
    public function getBadgeStats(): JsonResponse
    {
        $totalBadges = Badge::count();
        $totalAwarded = Badge::withCount('userBadges')->sum('user_badges_count');

        $badgesByType = Badge::selectRaw('type, count(*) as count')
            ->groupBy('type')
            ->get();

        $mostAwarded = Badge::withCount('userBadges')
            ->orderBy('user_badges_count', 'desc')
            ->limit(5)
            ->get(['id', 'name', 'user_badges_count']);

        return response()->json([
            'total_badges' => $totalBadges,
            'total_awarded' => $totalAwarded,
            'badges_by_type' => $badgesByType,
            'most_awarded' => $mostAwarded
        ]);
    }
}
