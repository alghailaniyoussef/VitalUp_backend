<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\ChallengeController;
use App\Http\Controllers\Auth\SanctumAuthController;
use App\Http\Controllers\DashboardDataController;
use App\Http\Controllers\UserPreferencesController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BadgeController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\AdminBadgeController;
use App\Http\Controllers\AdminQuizController;
use App\Http\Controllers\AdminTipController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\HealthNotificationController;
use App\Http\Controllers\Auth\VerificationController;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;

// Routes that don't need authentication
Route::post('/register', [SanctumAuthController::class, 'register']);
Route::post('/login', [SanctumAuthController::class, 'login']); // Ensure this route is used for API login

// Debug routes for troubleshooting authentication issues
Route::get('/debug/auth', function (\Illuminate\Http\Request $request) {
    $debugInfo = [
        'timestamp' => now()->toISOString(),
        'request_info' => [
            'method' => $request->method(),
            'url' => $request->fullUrl(),
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'origin' => $request->header('Origin'),
            'referer' => $request->header('Referer'),
        ],
        'headers' => [
            'accept' => $request->header('Accept'),
            'content_type' => $request->header('Content-Type'),
            'x_requested_with' => $request->header('X-Requested-With'),
            'csrf_token_header' => $request->header('X-XSRF-TOKEN') ? 'present' : 'missing',
            'authorization' => $request->header('Authorization') ? 'present' : 'missing',
            'cookie_header' => $request->header('Cookie') ? 'present' : 'missing',
        ],
        'session' => [
            'session_id' => $request->session()->getId(),
            'session_name' => config('session.cookie'),
            'session_driver' => config('session.driver'),
            'session_lifetime' => config('session.lifetime'),
            'session_domain' => config('session.domain'),
            'session_secure' => config('session.secure'),
            'session_same_site' => config('session.same_site'),
            'session_data_count' => count($request->session()->all()),
            'csrf_token_session' => $request->session()->token(),
        ],
        'auth' => [
            'auth_check' => \Illuminate\Support\Facades\Auth::check(),
            'auth_user_id' => \Illuminate\Support\Facades\Auth::id(),
            'auth_guard' => \Illuminate\Support\Facades\Auth::getDefaultDriver(),
            'sanctum_user' => $request->user() ? $request->user()->id : null,
        ],
        'cookies' => [
            'all_cookies' => $request->cookies->all(),
            'session_cookie' => $request->cookies->get(config('session.cookie')),
            'xsrf_token_cookie' => $request->cookies->get('XSRF-TOKEN'),
        ],
        'config' => [
            'app_url' => config('app.url'),
            'app_env' => config('app.env'),
            'sanctum_stateful_domains' => config('sanctum.stateful'),
            'cors_allowed_origins' => config('cors.allowed_origins'),
            'cors_supports_credentials' => config('cors.supports_credentials'),
        ]
    ];

    \Illuminate\Support\Facades\Log::info('Debug auth endpoint called', $debugInfo);
    return response()->json($debugInfo);
});

Route::post('/debug/test-login', function (\Illuminate\Http\Request $request) {
    $debugInfo = [
        'timestamp' => now()->toISOString(),
        'input' => $request->only(['email']),
        'headers' => [
            'origin' => $request->header('Origin'),
            'csrf_token' => $request->header('X-XSRF-TOKEN') ? 'present' : 'missing',
            'cookie' => $request->header('Cookie') ? 'present' : 'missing',
        ],
        'session_before' => [
            'id' => $request->session()->getId(),
            'token' => $request->session()->token(),
            'auth_check' => \Illuminate\Support\Facades\Auth::check(),
        ]
    ];

    if ($request->email) {
        $user = \App\Models\User::where('email', $request->email)->first();
        $debugInfo['user_found'] = $user ? true : false;
        if ($user) {
            $debugInfo['user_info'] = [
                'id' => $user->id,
                'email_verified' => $user->hasVerifiedEmail(),
                'created_at' => $user->created_at,
            ];
        }
    }

    \Illuminate\Support\Facades\Log::info('Debug test-login called', $debugInfo);
    return response()->json($debugInfo);
});

// Email verification routes
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verifyEmail'])
    ->middleware(['signed'])->name('verification.verify');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/email/verification-notification', [VerificationController::class, 'resend'])
        ->middleware(['throttle:6,1'])->name('verification.send');
});
// routes/api.php
Route::get('/health', function () {
    return response()->json(['status' => 'ok']);
});
// Debug routes to help troubleshoot session/auth issues
Route::get('/debug-session', function (Request $request) {
    return response()->json([
        'user_id' => optional($request->user())->id,
        'session_id' => $request->session()->getId(),
        'session_data' => $request->session()->all(),
        'auth_check' => Auth::check(),
        'cookie_header' => $request->header('cookie'),
    ]);
});

// Debug route to test middleware registration
Route::get('/debug-middleware', [\App\Http\Controllers\DebugController::class, '__invoke']);

// Debug route to test admin middleware specifically
Route::middleware([
    EnsureFrontendRequestsAreStateful::class,
    'auth:sanctum',
    'is_admin_user'
])->get('/debug-admin-middleware', [\App\Http\Controllers\DebugController::class, 'testAdminMiddleware']);

// Group all routes that need authentication
Route::middleware([
    EnsureFrontendRequestsAreStateful::class,
    'auth:sanctum'
])->group(function () {
    Route::get('/user', [SanctumAuthController::class, 'user']);
    Route::get('/dashboard-data', [DashboardDataController::class, 'index']);
    Route::post('/challenge/complete', [ChallengeController::class, 'completeChallenge']);
    Route::get('/challenges', [ChallengeController::class, 'listChallenges']);
    Route::post('/challenges/{challengeId}/join', [ChallengeController::class, 'joinChallenge']);

    // User preferences routes
    Route::get('/user/preferences', [UserPreferencesController::class, 'show']);
    Route::put('/user/preferences', [UserPreferencesController::class, 'update']);

    // User profile routes
    Route::get('/user/profile', [UserProfileController::class, 'show']);
    Route::put('/user/profile', [UserProfileController::class, 'update']);

    // Badges routes
    Route::get('/badges', [BadgeController::class, 'index']);

    // Quiz routes
    Route::get('/quizzes', [QuizController::class, 'index']);
    Route::get('/quizzes/{id}', [QuizController::class, 'show']);
    Route::post('/quizzes/{id}/submit', [QuizController::class, 'submitAnswers']);
    Route::post('/quizzes/{id}/complete', [QuizController::class, 'completeQuiz']);
    Route::get('/quiz-history', [QuizController::class, 'history']);

    // Health notification routes
    Route::get('/health/reminders', [HealthNotificationController::class, 'getActiveReminders']);
    Route::put('/health/reminders', [HealthNotificationController::class, 'updateReminderPreferences']);
    Route::get('/health/tips', [HealthNotificationController::class, 'getHealthTips']);
    Route::post('/health/send-reminder', [HealthNotificationController::class, 'sendHealthReminder']);

    // Points history routes
    Route::get('/points/history', [\App\Http\Controllers\UserPointsHistoryController::class, 'index']);
    Route::get('/points/summary', [\App\Http\Controllers\UserPointsHistoryController::class, 'summary']);

    // Admin routes
Route::prefix('admin')->middleware('is_admin_user')->group(function () {
    // Dashboard analytics
    Route::get('/analytics', [AdminController::class, 'dashboardAnalytics']);
    // User management
    Route::get('/users', [AdminController::class, 'getUsers']);
    Route::put('/users/{id}', [AdminController::class, 'updateUser']);
    Route::delete('/users/{id}', [AdminController::class, 'deleteUser']);
    Route::get('/interests', [AdminController::class, 'getInterests']);
    Route::get('/users/{id}/interests', [AdminController::class, 'getUserInterests']);
    Route::put('/users/{id}/interests', [AdminController::class, 'updateUserInterests']);

    // Challenge management
    Route::get('/challenges', [AdminController::class, 'getChallenges']);
    Route::post('/challenges', [AdminController::class, 'createChallenge']);
    Route::put('/challenges/{id}', [AdminController::class, 'updateChallenge']);
    Route::delete('/challenges/{id}', [AdminController::class, 'deleteChallenge']);

        // Badge management
        Route::get('/badges', [AdminBadgeController::class, 'getBadges']);
        Route::post('/badges', [AdminBadgeController::class, 'createBadge']);
        Route::put('/badges/{id}', [AdminBadgeController::class, 'updateBadge']);
        Route::delete('/badges/{id}', [AdminBadgeController::class, 'deleteBadge']);
        Route::get('/badges/stats', [AdminBadgeController::class, 'getBadgeStats']);

        // Quiz management
        Route::get('/quizzes', [AdminQuizController::class, 'getQuizzes']);
        Route::post('/quizzes', [AdminQuizController::class, 'createQuiz']);
        Route::put('/quizzes/{id}', [AdminQuizController::class, 'updateQuiz']);
        Route::delete('/quizzes/{id}', [AdminQuizController::class, 'deleteQuiz']);
        Route::get('/quizzes/stats', [AdminQuizController::class, 'getQuizStats']);

        // Tip management
        Route::get('/tips', [AdminTipController::class, 'getTips']);
        Route::post('/tips', [AdminTipController::class, 'createTip']);
        Route::put('/tips/{id}', [AdminTipController::class, 'updateTip']);
        Route::delete('/tips/{id}', [AdminTipController::class, 'deleteTip']);
        Route::get('/tips/stats', [AdminTipController::class, 'getTipStats']);
    });
});
