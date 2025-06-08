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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'points' => 0,
            'level' => 1,
        ]);

        // Create default user preferences
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

        // Send email verification notification
        $user->sendEmailVerificationNotification();

        // Fire UserRegistered event for welcome email
        event(new UserRegistered($user));
        Log::info('UserRegistered event fired for user: ' . $user->email);

        return response()->json([
            'message' => 'Usuario registrado exitosamente. Por favor verifica tu email antes de iniciar sesión.',
            'user' => $user,
            'email_verification_required' => true
        ], 201);
    }

    public function login(Request $req)
    {
        try {
            $req->validate([
                'email'    => 'required|email',
                'password' => 'required',
            ]);

            $user = User::where('email', $req->email)->first();

            if (!$user || !Hash::check($req->password, $user->password)) {
                return response()->json(['message' => 'Credenciales incorrectas'], 401);
            }

            // Check if email is verified
            if (!$user->hasVerifiedEmail()) {
                return response()->json([
                    'message' => 'Por favor verifica tu email antes de iniciar sesión.',
                    'email_verification_required' => true
                ], 403);
            }

            // Standard session-based authentication
            Auth::login($user);
            $req->session()->regenerate();

            // Create a token (optional, for API access)
            $token = $user->createToken('auth_token')->plainTextToken;

            // Return success message, user info, and token
            return response()->json([
                'message' => 'Login OK',
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                ],
                'token' => $token
            ]);
        } catch (\Exception $e) {
            Log::error('Login error: ' . $e->getMessage());
            return response()->json(['message' => 'Error de servidor al iniciar sesión'], 500);
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
            $user = $request->user();

            if (!$user) {
                return response()->json(['error' => 'Usuario no autenticado'], 401);
            }

            return response()->json([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'is_admin' => $user->is_admin,
            ]);
        } catch (\Exception $e) {
            Log::error('User fetch error: ' . $e->getMessage());
            return response()->json(['error' => 'Error al obtener información del usuario'], 500);
        }
    }
}
