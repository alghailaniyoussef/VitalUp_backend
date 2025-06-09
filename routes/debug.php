<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Sanctum\PersonalAccessToken;

// Debug route for authentication troubleshooting
Route::get('/debug/auth', function (Request $request) {
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
            'auth_check' => Auth::check(),
            'auth_user_id' => Auth::id(),
            'auth_guard' => Auth::getDefaultDriver(),
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
        ],
        'database' => [
            'sessions_table_exists' => \Schema::hasTable('sessions'),
            'users_table_exists' => \Schema::hasTable('users'),
            'personal_access_tokens_table_exists' => \Schema::hasTable('personal_access_tokens'),
        ]
    ];

    // Log the debug info
    Log::info('Debug auth endpoint called', $debugInfo);

    return response()->json($debugInfo);
});

// Debug route for testing login flow
Route::post('/debug/test-login', function (Request $request) {
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
            'auth_check' => Auth::check(),
        ]
    ];

    // Try to find user
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

    Log::info('Debug test-login called', $debugInfo);

    return response()->json($debugInfo);
});

// Debug route for CSRF cookie
Route::get('/debug/csrf', function (Request $request) {
    $debugInfo = [
        'timestamp' => now()->toISOString(),
        'session_id' => $request->session()->getId(),
        'csrf_token' => $request->session()->token(),
        'cookies_before' => $request->cookies->all(),
    ];

    Log::info('Debug CSRF endpoint called', $debugInfo);

    return response()->json($debugInfo);
});