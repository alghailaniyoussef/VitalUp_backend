<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Badge;
use App\Models\Challenge;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{


    /**
     * Get dashboard analytics data for admin
     */
    public function dashboardAnalytics(Request $request)
    {
        try {
            $locale = $request->header('Accept-Language', 'en');
            \Log::info('Dashboard analytics request with locale: ' . $locale);

            $totalUsers = User::count();
            // Note: last_login_at column doesn't exist, using created_at as proxy for now
            $activeUsers = User::where('created_at', '>=', now()->subDays(30))->count();
            $totalChallenges = Challenge::count();
            $totalQuizzes = Quiz::count();

            // Users by level
            $usersByLevel = User::select('level', DB::raw('count(*) as count'))
                ->groupBy('level')
                ->orderBy('level')
                ->get();

            // Recent registrations (last 7 days)
            $recentRegistrations = User::where('created_at', '>=', now()->subDays(7))->count();

            // Top challenges - since challenge_logs might be empty, show recent challenges instead
            \Log::info('Building top challenges query...');

            // First check if challenge_logs table has data
            $challengeLogsCount = DB::table('challenge_logs')->count();
            \Log::info('Challenge logs count: ' . $challengeLogsCount);

            $topChallenges = collect();

            if ($challengeLogsCount > 0) {
                // If we have challenge logs, use completion data
                $topChallenges = DB::table('challenge_logs')
                    ->join('challenges', 'challenge_logs.challenge', '=', 'challenges.title')
                    ->select('challenges.id', 'challenges.title', 'challenges.locale', DB::raw('count(*) as completions'))
                    ->groupBy('challenges.id', 'challenges.title', 'challenges.locale')
                    ->orderByDesc('completions')
                    ->limit(5)
                    ->get();
            } else {
                // If no challenge logs, show recent challenges from both locales
                $topChallenges = DB::table('challenges')
                    ->select('id', 'title', 'locale', DB::raw('0 as completions'))
                    ->orderBy('created_at', 'desc')
                    ->limit(5)
                    ->get();
            }

            \Log::info('Top challenges result count: ' . $topChallenges->count());

            return response()->json([
                'totalUsers' => $totalUsers,
                'activeUsers' => $activeUsers,
                'totalChallenges' => $totalChallenges,
                'totalQuizzes' => $totalQuizzes,
                'usersByLevel' => $usersByLevel,
                'recentRegistrations' => $recentRegistrations,
                'topChallenges' => $topChallenges
            ]);
        } catch (\Exception $e) {
            \Log::error('Error fetching dashboard analytics: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            \Log::error('File: ' . $e->getFile() . ' Line: ' . $e->getLine());
            return response()->json(['error' => 'Failed to fetch analytics', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Get all users (with pagination)
     */
    public function getUsers(Request $request)
    {
        $perPage = $request->input('per_page', 15);
        $locale = $request->input('locale');

        // If no locale specified, fetch all users with all their data
        // If locale specified, filter related data by that locale
        $users = User::with([
            'badges', // Always fetch all badges from both locales
            'challenges' => function($query) use ($locale) {
                if ($locale) {
                    $query->where('locale', $locale)
                          ->wherePivot('status', 'completed');
                } else {
                    $query->wherePivot('status', 'completed');
                }
            }
        ])->paginate($perPage);

        // Process interests and ensure proper data structure
        $users->getCollection()->transform(function ($user) use ($locale) {
            // Decode interests if they're stored as JSON string
            if (is_string($user->interests)) {
                $user->interests = json_decode($user->interests, true) ?: [];
            }

            // Ensure interests is always an array
            if (!is_array($user->interests)) {
                $user->interests = [];
            }

            // Only filter by locale if locale is specified
            if ($locale) {
                // Filter completed challenges to only include those matching the locale
                if ($user->challenges) {
                    $user->challenges = $user->challenges->filter(function ($challenge) use ($locale) {
                        return $challenge->locale === $locale;
                    });
                }

                // Filter badges to only include those matching the locale
                if ($user->badges) {
                    $user->badges = $user->badges->filter(function ($badge) use ($locale) {
                        return $badge->locale === $locale;
                    });
                }
            }

            return $user;
        });

        return response()->json($users);
    }

    /**
     * Update user details
     */
    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $data = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $id,
            'is_admin' => 'sometimes|boolean',
            'level' => 'sometimes|integer|min:1',
            'points' => 'sometimes|integer|min:0',
        ]);

        $user->update($data);

        return response()->json(['message' => 'User updated successfully', 'user' => $user]);
    }

    /**
     * Get all challenges (with pagination)
     */
    public function getChallenges(Request $request)
    {
        $locale = $request->input('locale');

        $query = Challenge::query();

        // If no locale specified, fetch all challenges
        // If locale specified, filter by that locale
        if ($locale) {
            $query->where('locale', $locale);
        }

        $challenges = $query->orderBy('created_at', 'desc')->paginate(10);

        return response()->json($challenges);
    }

    /**
     * Create a new challenge
     */
    public function createChallenge(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|in:physical,mental,social,environmental',
            'difficulty' => 'required|in:beginner,intermediate,advanced',
            'goals' => 'nullable|array',
            'duration_days' => 'required|integer|min:1',
            'points_reward' => 'required|integer|min:0',
            'badge_rewards' => 'nullable|array',
            'is_active' => 'boolean',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'locale' => 'required|in:en,es',
        ]);

        // Check if a challenge with the same title and locale already exists
        $existingChallenge = Challenge::where('title', $data['title'])
                                    ->where('locale', $data['locale'])
                                    ->first();

        if ($existingChallenge) {
            return response()->json([
                'message' => 'A challenge with this title already exists in this locale',
                'challenge' => $existingChallenge
            ], 422);
        }

        $challenge = Challenge::create($data);

        return response()->json(['message' => 'Challenge created successfully', 'challenge' => $challenge], 201);
    }

    /**
     * Update a challenge
     */
    public function updateChallenge(Request $request, $id)
    {
        $challenge = Challenge::findOrFail($id);

        $data = $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'category' => 'sometimes|in:physical,mental,social,environmental',
            'difficulty' => 'sometimes|in:beginner,intermediate,advanced',
            'goals' => 'sometimes|nullable|array',
            'duration_days' => 'sometimes|integer|min:1',
            'points_reward' => 'sometimes|integer|min:0',
            'badge_rewards' => 'sometimes|nullable|array',
            'is_active' => 'sometimes|boolean',
            'start_date' => 'sometimes|nullable|date',
            'end_date' => 'sometimes|nullable|date',
            'locale' => 'sometimes|in:en,es',
        ]);

        $challenge->update($data);

        return response()->json(['message' => 'Challenge updated successfully', 'challenge' => $challenge]);
    }

    /**
     * Delete a challenge
     */
    public function deleteChallenge($id)
    {
        $challenge = Challenge::findOrFail($id);
        $challenge->delete();

        return response()->json(['message' => 'Challenge deleted successfully']);
    }

    /**
     * Delete a user
     */
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }

    /**
     * Get all available interests
     */
    public function getInterests(Request $request)
    {
        $locale = $request->input('locale');

        $interests = [
            'en' => [
                'Fitness & Exercise',
                'Nutrition & Diet',
                'Mental Health',
                'Mindfulness & Meditation',
                'Sleep & Recovery',
                'Stress Management',
                'Healthy Cooking',
                'Outdoor Activities',
                'Yoga & Pilates',
                'Weight Management',
                'Preventive Care',
                'Wellness Technology',
                'Social Wellness',
                'Environmental Health'
            ],
            'es' => [
                'Fitness y Ejercicio',
                'Nutrición y Dieta',
                'Salud Mental',
                'Mindfulness y Meditación',
                'Sueño y Recuperación',
                'Manejo del Estrés',
                'Cocina Saludable',
                'Actividades al Aire Libre',
                'Yoga y Pilates',
                'Control de Peso',
                'Cuidado Preventivo',
                'Tecnología de Bienestar',
                'Bienestar Social',
                'Salud Ambiental'
            ]
        ];

        // If no locale specified, return all interests
        if (!$locale) {
            $allInterests = array_merge($interests['en'], $interests['es']);
            return response()->json(['interests' => $allInterests]);
        }

        return response()->json(['interests' => $interests[$locale] ?? $interests['en']]);
    }

    /**
     * Get user interests
     */
    public function getUserInterests(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $locale = $request->input('locale', 'en');

        // Get user's interests with safety checks
        $userInterests = $user->interests ?? [];

        // Decode interests if they're stored as JSON string
        if (is_string($userInterests)) {
            $userInterests = json_decode($userInterests, true) ?: [];
        }

        // Ensure interests is always an array
        if (!is_array($userInterests)) {
            $userInterests = [];
        }

        // Define mapping from stored keys to display names by locale
        $interestMapping = [
            'en' => [
                'fitness' => 'Fitness & Exercise',
                'nutrition' => 'Nutrition & Diet',
                'mental_health' => 'Mental Health',
                'mindfulness' => 'Mindfulness & Meditation',
                'sleep' => 'Sleep & Recovery',
                'stress_management' => 'Stress Management',
                'healthy_cooking' => 'Healthy Cooking',
                'outdoor_activities' => 'Outdoor Activities',
                'yoga' => 'Yoga & Pilates',
                'weight_management' => 'Weight Management',
                'preventive_care' => 'Preventive Care',
                'wellness_technology' => 'Wellness Technology',
                'social_wellness' => 'Social Wellness',
                'environmental_health' => 'Environmental Health'
            ],
            'es' => [
                'fitness' => 'Fitness y Ejercicio',
                'nutrition' => 'Nutrición y Dieta',
                'mental_health' => 'Salud Mental',
                'mindfulness' => 'Mindfulness y Meditación',
                'sleep' => 'Sueño y Recuperación',
                'stress_management' => 'Manejo del Estrés',
                'healthy_cooking' => 'Cocina Saludable',
                'outdoor_activities' => 'Actividades al Aire Libre',
                'yoga' => 'Yoga y Pilates',
                'weight_management' => 'Control de Peso',
                'preventive_care' => 'Cuidado Preventivo',
                'wellness_technology' => 'Tecnología de Bienestar',
                'social_wellness' => 'Bienestar Social',
                'environmental_health' => 'Salud Ambiental'
            ]
        ];

        // Map user's stored interest keys to display names in the requested locale
        $mapping = $interestMapping[$locale] ?? $interestMapping['en'];
        $displayInterests = [];

        foreach ($userInterests as $interestKey) {
            if (isset($mapping[$interestKey])) {
                $displayInterests[] = $mapping[$interestKey];
            }
        }

        return response()->json(['interests' => $displayInterests]);
    }

    /**
     * Update user interests
     */
    public function updateUserInterests(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $data = $request->validate([
            'interests' => 'required|array',
            'interests.*' => 'string'
        ]);

        $user->interests = $data['interests'];
        $user->save();

        return response()->json([
            'message' => 'User interests updated successfully',
            'interests' => $user->interests
        ]);
    }
}
