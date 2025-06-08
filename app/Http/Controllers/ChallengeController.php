<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChallengeLog;
use App\Models\Challenge;
use App\Models\User;
use App\Models\UserChallenge;
use App\Models\UserPointsHistory;
use App\Events\ChallengeCompleted;
use App\Services\TranslationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
class ChallengeController extends Controller
{

    public function completeChallenge(Request $request)
    {
        $user = $request->user();
    $challenge = $request->input('challenge');
    $category = $request->input('category', null);

    // Evitar duplicados en el mismo día
    $alreadyDone = ChallengeLog::where('user_id', $user->id)
        ->where('challenge', $challenge)
        ->whereDate('completed_at', Carbon::today())
        ->exists();

    if ($alreadyDone) {
        return response()->json(['message' => 'Este reto ya fue completado hoy.']);
    }

    // Crear nuevo registro
    ChallengeLog::create([
        'user_id' => $user->id,
        'challenge' => $challenge,
        'category' => $category,
        'completed_at' => now(),
    ]);

    // Añadir puntos y subir nivel
    $user->points += 100;
    if ($user->points >= 1000) {
        $user->level++;
        $user->points = 0;
    }
    $user->save();

    // Create points history entry
    UserPointsHistory::createEntry(
        $user,
        100,
        'challenge',
        null,
        "Completed challenge: {$challenge}"
    );

    // Fire challenge completed event for notifications
    event(new \App\Events\ChallengeCompleted($user, (object)['name' => $challenge, 'category' => $category, 'points' => 100]));

    return response()->json(['message' => 'Reto registrado con éxito', 'points' => $user->points, 'level' => $user->level]);

    }

    public function listChallenges(Request $request)
    {
        $user = $request->user();
        $filterByInterests = $request->query('filter_by_interests', 'true') === 'true';
        // Get locale from query parameter first, then from header
        $locale = $request->query('locale') ?: $request->header('Accept-Language', 'en');
        // Extract locale from header like 'en-US' or 'es-ES'
        $locale = substr($locale, 0, 2);
        
        // Log the locale for debugging
        \Log::info('Challenge API request with locale: ' . $locale);

        // Get available challenges (active and within date range)
        $availableChallengesQuery = \App\Models\Challenge::where('is_active', true)
            ->where('locale', $locale)
            ->where(function ($query) {
                $query->whereNull('start_date')
                    ->orWhere('start_date', '<=', now());
            })
            ->where(function ($query) {
                $query->whereNull('end_date')
                    ->orWhere('end_date', '>=', now());
            })
            ->whereNotIn('id', function ($query) use ($user) {
                $query->select('challenge_id')
                    ->from('user_challenges')
                    ->where('user_id', $user->id);
            });

        // Filter by user interests if requested and user has interests set
        if ($filterByInterests) {
            // Only apply interest filtering if user has interests
            if (!empty($user->interests)) {
                $availableChallengesQuery->where(function ($query) use ($user) {
                    // Map specific interests to challenge categories
                    $interestToCategoryMap = [
                        // Fitness related
                        'running' => 'physical',
                        'cycling' => 'physical',
                        'swimming' => 'physical',
                        'hiking' => 'physical',
                        'yoga' => 'physical',
                        'fitness' => 'physical',

                        // Mental health related
                        'meditation' => 'mental',
                        'mental_health' => 'mental',
                        'stress_management' => 'mental',
                        'sleep' => 'sleep',

                        // Wellness related
                        'nutrition' => 'nutrition',
                        'wellness' => 'wellness',
                        'hydration' => 'wellness',

                        // Social related
                        'work_life_balance' => 'social',
                        'social_wellness' => 'social',
                        'social' => 'social',

                        // Environmental related
                        'environmental' => 'environmental',
                        'sustainability' => 'environmental',
                        'eco_friendly' => 'environmental'
                    ];

                    // Handle interests that might be stored as JSON string
                    $userInterests = $user->interests;
                    if (is_string($userInterests)) {
                        $userInterests = json_decode($userInterests, true) ?? [];
                    }
                    if (!is_array($userInterests)) {
                        $userInterests = [];
                    }

                    $relevantCategories = [];
                    foreach ($userInterests as $interest) {
                        if (isset($interestToCategoryMap[$interest])) {
                            $relevantCategories[] = $interestToCategoryMap[$interest];
                        } else {
                            // If no mapping exists, use the interest directly
                            $relevantCategories[] = $interest;
                        }
                    }

                    // Remove duplicates
                    $relevantCategories = array_unique($relevantCategories);

                    foreach ($relevantCategories as $category) {
                        $query->orWhere('category', $category);
                    }
                });
            }
        }
        // If user has no interests set or filter_by_interests is false, show all challenges

        $availableChallenges = $availableChallengesQuery->get()->map(function ($challenge) use ($locale) {
            return [
                'id' => $challenge->id,
                'title' => $challenge->title,
                'title_translated' => TranslationService::translate('challenge_title', $challenge->title, $locale),
                'description' => $challenge->description,
                'description_translated' => TranslationService::translate('challenge_description', $challenge->description, $locale),
                'category' => $challenge->category,
                'category_translated' => TranslationService::translate('challenge_category', $challenge->category, $locale),
                'difficulty' => $challenge->difficulty,
                'difficulty_translated' => TranslationService::translate('challenge_difficulty', $challenge->difficulty, $locale),
                'goals' => $challenge->goals,
                'duration_days' => $challenge->duration_days,
                'points_reward' => $challenge->points_reward,
                'badge_rewards' => $challenge->badge_rewards,
                'start_date' => $challenge->start_date,
                'end_date' => $challenge->end_date,
                'is_active' => $challenge->is_active,
            ];
        });

        // Get user's active challenges - filter by locale
        $activeChallenges = $user->challenges()
            ->wherePivot('status', '!=', 'completed')
            ->where('locale', $locale) // Filter by locale
            ->distinct() // Add distinct to prevent duplicates
            ->get()
            ->map(function ($challenge) use ($locale) {
                return [
                    'id' => $challenge->id,
                    'title' => $challenge->title,
                    'title_translated' => TranslationService::translate('challenge_title', $challenge->title, $locale),
                    'description' => $challenge->description,
                    'description_translated' => TranslationService::translate('challenge_description', $challenge->description, $locale),
                    'category' => $challenge->category,
                    'category_translated' => TranslationService::translate('challenge_category', $challenge->category, $locale),
                    'difficulty' => $challenge->difficulty,
                    'difficulty_translated' => TranslationService::translate('challenge_difficulty', $challenge->difficulty, $locale),
                    'goals' => $challenge->goals,
                    'duration_days' => $challenge->duration_days,
                    'points_reward' => $challenge->points_reward,
                    'badge_rewards' => $challenge->badge_rewards,
                    'progress' => $challenge->pivot->progress ?? 0,
                    'status' => $challenge->pivot->status ?? 'not_started',
                    'status_translated' => TranslationService::translate('challenge_status', $challenge->pivot->status ?? 'not_started', $locale),
                    'started_at' => $challenge->pivot->started_at,
                    'completed_at' => $challenge->pivot->completed_at,
                ];
            });
        
        \Log::info('Active challenges count: ' . $activeChallenges->count());

        // Get user's completed challenges - filter by locale
        $completedChallenges = $user->challenges()
            ->wherePivot('status', 'completed')
            ->where('locale', $locale) // Filter by locale
            ->distinct() // Add distinct to prevent duplicates
            ->get()
            ->map(function ($challenge) use ($locale) {
                return [
                    'id' => $challenge->id,
                    'title' => $challenge->title,
                    'title_translated' => TranslationService::translate('challenge_title', $challenge->title, $locale),
                    'description' => $challenge->description,
                    'description_translated' => TranslationService::translate('challenge_description', $challenge->description, $locale),
                    'category' => $challenge->category,
                    'category_translated' => TranslationService::translate('challenge_category', $challenge->category, $locale),
                    'difficulty' => $challenge->difficulty,
                    'difficulty_translated' => TranslationService::translate('challenge_difficulty', $challenge->difficulty, $locale),
                    'goals' => $challenge->goals,
                    'duration_days' => $challenge->duration_days,
                    'points_reward' => $challenge->points_reward,
                    'badge_rewards' => $challenge->badge_rewards,
                    'progress' => $challenge->pivot->progress ?? 100,
                    'status' => $challenge->pivot->status,
                    'status_translated' => TranslationService::translate('challenge_status', $challenge->pivot->status, $locale),
                    'started_at' => $challenge->pivot->started_at,
                    'completed_at' => $challenge->pivot->completed_at,
                ];
            });
            
        \Log::info('Completed challenges count: ' . $completedChallenges->count());

        return response()->json([
            'available_challenges' => $availableChallenges,
            'active_challenges' => $activeChallenges,
            'completed_challenges' => $completedChallenges,
        ]);
    }

    public function joinChallenge(Request $request, $challengeId)
    {
        $user = $request->user();
        $challenge = \App\Models\Challenge::findOrFail($challengeId);
        $locale = $request->header('Accept-Language', 'en');
        // Extract locale from header like 'en-US' or 'es-ES'
        $locale = substr($locale, 0, 2);

        // Check if user is already participating in this challenge
        if ($user->challenges()->where('challenge_id', $challengeId)->distinct()->exists()) {
            return response()->json(['message' => 'You are already participating in this challenge'], 400);
        }

        // Check if challenge is available
        if (!$challenge->isAvailable()) {
            return response()->json(['message' => 'This challenge is not available'], 400);
        }

        // Join the challenge
        $user->challenges()->attach($challengeId, [
            'status' => 'active',
            'progress' => 0,
            'started_at' => now(),
        ]);

        // Fire ChallengeJoined event for notifications
        event(new \App\Events\ChallengeJoined($user, $challenge));

        // Return the joined challenge with pivot data
        $joinedChallenge = $user->challenges()->where('challenge_id', $challengeId)->distinct()->first();

        return response()->json([
            'id' => $joinedChallenge->id,
            'title' => $joinedChallenge->title,
            'title_translated' => TranslationService::translate('challenge_title', $joinedChallenge->title, $locale),
            'description' => $joinedChallenge->description,
            'description_translated' => TranslationService::translate('challenge_description', $joinedChallenge->description, $locale),
            'category' => $joinedChallenge->category,
            'category_translated' => TranslationService::translate('challenge_category', $joinedChallenge->category, $locale),
            'difficulty' => $joinedChallenge->difficulty,
            'difficulty_translated' => TranslationService::translate('challenge_difficulty', $joinedChallenge->difficulty, $locale),
            'goals' => $joinedChallenge->goals,
            'duration_days' => $joinedChallenge->duration_days,
            'points_reward' => $joinedChallenge->points_reward,
            'badge_rewards' => $joinedChallenge->badge_rewards,
            'progress' => $joinedChallenge->pivot->progress,
            'status' => $joinedChallenge->pivot->status,
            'status_translated' => TranslationService::translate('challenge_status', $joinedChallenge->pivot->status, $locale),
            'started_at' => $joinedChallenge->pivot->started_at,
        ]);
    }

    public function getUserChallenges(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        $category = $request->input('category', null);
        $locale = $request->header('Accept-Language', 'en');
        // Extract locale from header like 'en-US' or 'es-ES'
        $locale = substr($locale, 0, 2);

        // Get available challenges (not joined by user)
        $availableChallengesQuery = Challenge::where('is_active', true)
            ->whereNotIn('id', function($query) use ($user) {
                $query->select('challenge_id')
                      ->from('user_challenges')
                      ->where('user_id', $user->id);
            });

        if ($category) {
            $availableChallengesQuery->where('category', $category);
        }

        $availableChallenges = $availableChallengesQuery->get()->map(function ($challenge) use ($locale) {
            return [
                'id' => $challenge->id,
                'title' => $challenge->title,
                'description' => $challenge->description,
                'category' => $challenge->category,
                'category_translated' => TranslationService::translate('challenge_category', $challenge->category, $locale),
                'difficulty' => $challenge->difficulty,
                'difficulty_translated' => TranslationService::translate('challenge_difficulty', $challenge->difficulty, $locale),
                'goals' => $challenge->goals,
                'duration_days' => $challenge->duration_days,
                'points_reward' => $challenge->points_reward,
                'badge_rewards' => $challenge->badge_rewards,
                'start_date' => $challenge->start_date,
                'end_date' => $challenge->end_date,
            ];
        });

        return response()->json([
            'available_challenges' => $availableChallenges,
        ]);
    }

}
