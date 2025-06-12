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
        \Log::info('🔐 Token-based login attempt started', [
            'timestamp' => now()->toISOString(),
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'origin' => $request->header('Origin'),
            'method' => $request->method(),
            'url' => $request->fullUrl(),
        ]);

        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            \Log::info('🔍 Validation passed, attempting authentication');

            $credentials = $request->only('email', 'password');
            
            \Log::info('🔑 Attempting auth with credentials', [
                'email' => $credentials['email'],
                'password_length' => strlen($credentials['password'])
            ]);

            if (Auth::attempt($credentials)) {
                \Log::info('✅ Authentication successful');
                
                $user = Auth::user();
                \Log::info('👤 User authenticated', [
                    'user_id' => $user->id,
                    'user_email' => $user->email,
                    'user_name' => $user->name,
                    'email_verified' => $user->hasVerifiedEmail()
                ]);

                // Check if email is verified
                if (!$user->hasVerifiedEmail()) {
                    \Log::warning('❌ Login blocked - email not verified', [
                        'user_id' => $user->id,
                        'email' => $user->email
                    ]);
                    
                    return response()->json([
                        'message' => 'Tu email no ha sido verificado. Por favor verifica tu email antes de iniciar sesión.',
                        'error' => 'email_not_verified',
                        'email_verification_required' => true
                    ], 403);
                }

                // Check if user should receive welcome back email
                $lastLogin = $user->last_login_at;
                $daysSinceLastLogin = 0;
                
                if ($lastLogin) {
                    $daysSinceLastLogin = now()->diffInDays($lastLogin);
                    
                    // Send welcome back email if user hasn't logged in for 7+ days
                    if ($daysSinceLastLogin >= 7) {
                        try {
                            $emailService = app(\App\Services\EmailNotificationService::class);
                            $emailService->sendWelcomeBackEmail($user, $daysSinceLastLogin);
                            \Log::info('Welcome back email sent', [
                                'user_id' => $user->id,
                                'days_since_last_login' => $daysSinceLastLogin
                            ]);
                        } catch (\Exception $e) {
                            \Log::error('Failed to send welcome back email', [
                                'user_id' => $user->id,
                                'error' => $e->getMessage()
                            ]);
                        }
                    }
                }
                
                // Update last login timestamp
                $user->update(['last_login_at' => now()]);

                // Create Sanctum token
                $token = $user->createToken('auth-token')->plainTextToken;
                \Log::info('🎫 Sanctum token created successfully');

                return response()->json([
                    'message' => 'Login successful',
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'email_verified_at' => $user->email_verified_at,
                        'last_login_at' => $user->last_login_at,
                        'days_since_last_login' => $daysSinceLastLogin,
                    ],
                    'token' => $token,
                    'token_type' => 'Bearer'
                ], 200);
            } else {
                \Log::warning('❌ Authentication failed - invalid credentials', [
                    'email' => $credentials['email']
                ]);
                
                return response()->json([
                    'message' => 'Invalid credentials'
                ], 401);
            }
        } catch (ValidationException $e) {
            \Log::error('❌ Validation failed', [
                'errors' => $e->errors(),
                'input' => $request->except('password')
            ]);
            
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('❌ Login error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'input' => $request->except('password')
            ]);
            
            return response()->json([
                'message' => 'Login failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            \Log::info('🚪 Token-based logout attempt started', [
                'user_id' => Auth::id(),
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]);

            // Delete the current access token
            $request->user()->currentAccessToken()->delete();
            
            \Log::info('✅ Token logout successful');
            
            return response()->json([
                'message' => 'Logout successful'
            ], 200);
        } catch (\Exception $e) {
            \Log::error('❌ Logout error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'message' => 'Logout failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function user(Request $request)
    {
        try {
            Log::info('User endpoint called', [
                'auth_check' => Auth::check(),
                'auth_user_id' => Auth::id(),
                'origin' => $request->header('Origin'),
                'authorization_header' => $request->header('Authorization') ? 'present' : 'missing',
                'user_agent' => $request->userAgent()
            ]);

            $user = $request->user();

            if (!$user) {
                Log::warning('User endpoint: No authenticated user found', [
                    'auth_check' => Auth::check(),
                    'authorization_header' => $request->header('Authorization') ? 'present' : 'missing'
                ]);
                return response()->json([
                    'error' => 'Usuario no autenticado',
                    'debug' => [
                        'auth_check' => Auth::check(),
                        'authorization_header_present' => $request->header('Authorization') ? true : false
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
                    'auth_check' => Auth::check(),
                    'authorization_header_present' => $request->header('Authorization') ? true : false
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('User fetch error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'authorization_header' => $request->header('Authorization') ? 'present' : 'missing'
            ]);
            return response()->json([
                'error' => 'Error al obtener información del usuario',
                'debug' => [
                    'authorization_header_present' => $request->header('Authorization') ? true : false,
                    'error_message' => $e->getMessage()
                ]
            ], 500);
        }
    }

    public function sendWelcomeEmail(Request $request)
    {
        try {
            $user = $request->user();
            
            if (!$user) {
                return response()->json([
                    'message' => 'User not authenticated'
                ], 401);
            }

            $emailService = app(\App\Services\EmailNotificationService::class);
            $emailService->sendWelcomeEmail($user);
            
            \Log::info('Welcome email sent successfully', [
                'user_id' => $user->id,
                'email' => $user->email
            ]);
            
            return response()->json([
                'message' => 'Welcome email sent successfully'
            ], 200);
            
        } catch (\Exception $e) {
            \Log::error('Failed to send welcome email', [
                'user_id' => $request->user()?->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'message' => 'Failed to send welcome email',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
