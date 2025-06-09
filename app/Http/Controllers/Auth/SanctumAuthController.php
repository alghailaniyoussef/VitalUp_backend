<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Events\UserRegistered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\PersonalAccessToken;

class SanctumAuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            Log::info('Registration attempt started', ['email' => $request->email]);
            
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ]);
            
            Log::info('Validation passed, creating user');

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'points' => 0,
                'level' => 1,
            ]);
            
            Log::info('User created successfully', ['user_id' => $user->id]);

            // Create default user preferences
            try {
                $user->preferences()->create([
                    'notification_preferences' => [
                        'quiz_reminders' => true,
                        'challenge_updates' => true,
                        'achievement_alerts' => true,
                        'weekly_summaries' => true,
                        'marketing_emails' => false,
                        'email_frequency' => 'weekly'
                    ],
                    'privacy_settings' => [
                        'profile_visibility' => 'private',
                        'share_achievements' => false,
                        'share_progress' => false
                    ],
                    'data_processing_consents' => [
                        'analytics' => false,
                        'personalization' => false,
                        'third_party_sharing' => false
                    ]
                ]);
                Log::info('User preferences created successfully');
            } catch (\Exception $e) {
                Log::error('Failed to create user preferences: ' . $e->getMessage());
                // Continue without preferences for now
            }

            // Send email verification notification
            try {
                $user->sendEmailVerificationNotification();
                Log::info('Email verification notification sent');
            } catch (\Exception $e) {
                Log::error('Failed to send email verification: ' . $e->getMessage());
                // Continue without email verification for now
            }

            // Fire UserRegistered event for welcome email
            try {
                event(new UserRegistered($user));
                Log::info('UserRegistered event fired for user: ' . $user->email);
            } catch (\Exception $e) {
                Log::error('Failed to fire UserRegistered event: ' . $e->getMessage());
                // Continue without event for now
            }

            return response()->json([
                'message' => 'Usuario registrado exitosamente. Por favor verifica tu email antes de iniciar sesión.',
                'user' => $user->only(['id', 'name', 'email', 'points', 'level']),
                'email_verification_required' => true,
                'redirect_to_login' => true
            ], 201);
            
        } catch (ValidationException $e) {
            Log::error('Validation failed during registration', ['errors' => $e->errors()]);
            throw $e;
        } catch (\Exception $e) {
            Log::error('Registration failed with exception: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            return response()->json([
                'message' => 'Registration failed. Please try again.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function login(Request $request)
    {
        try {
            Log::info('Login attempt started', [
                'email' => $request->email,
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'origin' => $request->header('Origin'),
                'referer' => $request->header('Referer'),
                'session_id' => $request->session()->getId(),
                'csrf_token' => $request->header('X-XSRF-TOKEN') ? 'present' : 'missing',
                'cookies' => $request->header('Cookie') ? 'present' : 'missing'
            ]);

            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            Log::info('Login validation passed');

            $user = User::where('email', $request->email)->first();

            if (!$user) {
                Log::warning('Login failed: User not found', ['email' => $request->email]);
                return response()->json(['message' => 'Credenciales incorrectas'], 401);
            }

            if (!Hash::check($request->password, $user->password)) {
                Log::warning('Login failed: Invalid password', ['user_id' => $user->id, 'email' => $request->email]);
                return response()->json(['message' => 'Credenciales incorrectas'], 401);
            }

            Log::info('Password verification passed', ['user_id' => $user->id]);

            // Check if email is verified
            if (!$user->hasVerifiedEmail()) {
                Log::warning('Login failed: Email not verified', ['user_id' => $user->id]);
                return response()->json([
                    'message' => 'Por favor verifica tu email antes de iniciar sesión.',
                    'email_verification_required' => true
                ], 403);
            }

            Log::info('Email verification check passed', ['user_id' => $user->id]);

            // Login the user (this will create the session)
            Auth::login($user);
            $request->session()->regenerate();

            Log::info('User logged in successfully', [
                'user_id' => $user->id,
                'session_id' => $request->session()->getId(),
                'auth_check' => Auth::check(),
                'auth_user_id' => Auth::id()
            ]);

            // Create a token for API access
            $token = $user->createToken('auth_token')->plainTextToken;

            Log::info('Token created successfully', ['user_id' => $user->id]);

            $response = response()->json([
                'message' => 'Login OK',
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'points' => $user->points ?? 0,
                    'level' => $user->level ?? 1,
                    'is_admin' => (bool) $user->is_admin,
                    'email_verified_at' => $user->email_verified_at,
                ],
                'token' => $token,
                'debug' => [
                    'session_id' => $request->session()->getId(),
                    'auth_check' => Auth::check(),
                    'csrf_token_present' => $request->header('X-XSRF-TOKEN') ? true : false,
                    'origin' => $request->header('Origin'),
                    'user_agent' => $request->userAgent()
                ]
            ]);

            Log::info('Login response prepared', ['user_id' => $user->id]);

            return $response;

        } catch (ValidationException $e) {
            Log::error('Login validation failed', ['errors' => $e->errors()]);
            throw $e;
        } catch (\Exception $e) {
            Log::error('Login failed with exception: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'email' => $request->email ?? 'not provided'
            ]);
            return response()->json([
                'message' => 'Login failed. Please try again.',
                'error' => $e->getMessage(),
                'debug' => [
                    'session_id' => $request->session()->getId(),
                    'origin' => $request->header('Origin'),
                    'csrf_token_present' => $request->header('X-XSRF-TOKEN') ? true : false
                ]
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            // Get the user before we invalidate the session
            $user = $request->user();

            if ($user) {
                // Delete the current token if using token-based auth
                if ($request->bearerToken()) {
                    $user->currentAccessToken()->delete();
                }
            }

            // Handle session-based logout
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return response()->json(['message' => 'Logged out']);
        } catch (\Exception $e) {
            Log::error('Logout error: ' . $e->getMessage());
            return response()->json(['message' => 'Error de servidor al cerrar sesión'], 500);
        }
    }

    public function user(Request $request)
    {
        try {
            Log::info('User endpoint called', [
                'session_id' => $request->session()->getId(),
                'auth_check' => Auth::check(),
                'auth_user_id' => Auth::id(),
                'origin' => $request->header('Origin'),
                'csrf_token' => $request->header('X-XSRF-TOKEN') ? 'present' : 'missing',
                'cookies' => $request->header('Cookie') ? 'present' : 'missing',
                'user_agent' => $request->userAgent()
            ]);

            $user = $request->user();

            if (!$user) {
                Log::warning('User endpoint: No authenticated user found', [
                    'session_id' => $request->session()->getId(),
                    'auth_check' => Auth::check(),
                    'session_data' => $request->session()->all()
                ]);
                return response()->json([
                    'error' => 'Usuario no autenticado',
                    'debug' => [
                        'session_id' => $request->session()->getId(),
                        'auth_check' => Auth::check(),
                        'csrf_token_present' => $request->header('X-XSRF-TOKEN') ? true : false
                    ]
                ], 401);
            }

            Log::info('User endpoint: User found', ['user_id' => $user->id]);

            return response()->json([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'points' => $user->points ?? 0,
                'level' => $user->level ?? 1,
                'is_admin' => (bool) $user->is_admin,
                'email_verified_at' => $user->email_verified_at,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
                'debug' => [
                    'session_id' => $request->session()->getId(),
                    'auth_check' => Auth::check(),
                    'csrf_token_present' => $request->header('X-XSRF-TOKEN') ? true : false
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('User fetch error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'session_id' => $request->session()->getId()
            ]);
            return response()->json([
                'error' => 'Error al obtener información del usuario',
                'debug' => [
                    'session_id' => $request->session()->getId(),
                    'error_message' => $e->getMessage()
                ]
            ], 500);
        }
    }
}
