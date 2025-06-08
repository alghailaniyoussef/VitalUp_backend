<?php

namespace App\Http\Controllers;

use App\Models\UserPointsHistory;
use App\Services\TranslationService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserPointsHistoryController extends Controller
{
    /**
     * Get the authenticated user's points history
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $user = Auth::user();
            $locale = $request->header('Accept-Language', 'en');

            if (!$user) {
                return response()->json(['error' => 'User not authenticated'], 401);
            }

            $perPage = $request->get('per_page', 20);
            $page = $request->get('page', 1);

            $pointsHistory = UserPointsHistory::where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->paginate($perPage, ['*'], 'page', $page);

            // Add source details and translations for each entry
            $pointsHistory->getCollection()->transform(function ($entry) use ($locale) {
                $sourceDetails = null;

                switch ($entry->source_type) {
                    case 'quiz':
                        $quiz = \App\Models\Quiz::find($entry->source_id);
                        $sourceDetails = $quiz ? ['title' => $quiz->title] : null;
                        break;
                    case 'badge':
                        $badge = \App\Models\Badge::find($entry->source_id);
                        $sourceDetails = $badge ? ['name' => $badge->name, 'icon_path' => $badge->icon_path] : null;
                        break;
                    case 'challenge':
                        $challenge = \App\Models\Challenge::find($entry->source_id);
                        $sourceDetails = $challenge ? ['title' => $challenge->title] : null;
                        break;
                }

                $entry->source_details = $sourceDetails;

                // Add translated source type
                $entry->source_type_translated = TranslationService::translate('points_source_type', $entry->source_type, $locale);

                return $entry;
            });

            return response()->json([
                'data' => $pointsHistory->items(),
                'current_page' => $pointsHistory->currentPage(),
                'last_page' => $pointsHistory->lastPage(),
                'per_page' => $pointsHistory->perPage(),
                'total' => $pointsHistory->total(),
                'total_points' => $user->points
            ]);

        } catch (\Exception $e) {
            Log::error('Error fetching user points history: ' . $e->getMessage());

            return response()->json([
                'error' => 'Failed to fetch points history',
                'message' => config('app.debug') ? $e->getMessage() : 'Internal server error'
            ], 500);
        }
    }

    /**
     * Get points summary for the user
     */
    public function summary(): JsonResponse
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return response()->json(['error' => 'User not authenticated'], 401);
            }

            $summary = [
                'total_points' => $user->points,
                'points_from_quizzes' => UserPointsHistory::where('user_id', $user->id)
                    ->where('source_type', 'quiz')
                    ->sum('points'),
                'points_from_badges' => UserPointsHistory::where('user_id', $user->id)
                    ->where('source_type', 'badge')
                    ->sum('points'),
                'points_from_challenges' => UserPointsHistory::where('user_id', $user->id)
                    ->where('source_type', 'challenge')
                    ->sum('points'),
                'recent_activity' => UserPointsHistory::where('user_id', $user->id)
                    ->orderBy('created_at', 'desc')
                    ->limit(5)
                    ->get()
            ];

            return response()->json($summary);

        } catch (\Exception $e) {
            Log::error('Error fetching points summary: ' . $e->getMessage());

            return response()->json([
                'error' => 'Failed to fetch points summary',
                'message' => config('app.debug') ? $e->getMessage() : 'Internal server error'
            ], 500);
        }
    }
}
