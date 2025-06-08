<?php

namespace App\Http\Controllers;

use App\Models\UserPreference;
use App\Services\TranslationService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UserPreferencesController extends Controller
{
    public function show(Request $request): JsonResponse
    {
        $user = Auth::user();
        $locale = $request->header('Accept-Language', 'en');
        // Extract locale from header like 'en-US' or 'es-ES'
        $locale = substr($locale, 0, 2);

        $preferences = UserPreference::firstOrCreate(
            ['user_id' => $user->id],
            [
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
            ]
        );

        // Include user interests in the response
        $response = $preferences->toArray();
        $response['interests'] = $user->interests ?? [];

        // Organize interests by categories that match challenge categories
        $availableInterests = [
            'physical' => ['fitness', 'running', 'cycling', 'swimming', 'hiking', 'yoga'],
            'mental' => ['mental_health', 'meditation', 'stress_management'],
            'sleep' => ['sleep'],
            'nutrition' => ['nutrition'],
            'wellness' => ['wellness', 'hydration'],
            'social' => ['social', 'work_life_balance', 'social_wellness'],
            'environmental' => ['environmental', 'sustainability', 'eco_friendly']
        ];

        // Add translations for interests
        $response['available_interests'] = [];
        $response['available_interests_translated'] = [];
        foreach ($availableInterests as $category => $interests) {
            $response['available_interests'][$category] = $interests;
            $response['available_interests_translated'][$category] = [
                'category' => TranslationService::translate('interest_category', $category, $locale),
                'interests' => array_map(function($interest) use ($locale) {
                    return [
                        'key' => $interest,
                        'label' => TranslationService::translate('interest_category', $interest, $locale)
                    ];
                }, $interests)
            ];
        }

        $response['available_interest_categories'] = ['physical', 'mental', 'sleep', 'nutrition', 'wellness', 'social', 'environmental'];
        $response['available_interest_categories_translated'] = [];
        foreach ($response['available_interest_categories'] as $category) {
            $response['available_interest_categories_translated'][$category] = TranslationService::translate('interest_category', $category, $locale);
        }

        // For backward compatibility, also provide the old format
        $response['legacy_categories'] = ['fitness', 'mental_health', 'wellness', 'social'];

        return response()->json($response);
    }

    public function update(Request $request): JsonResponse
    {
        $user = Auth::user();
        $preferences = UserPreference::where('user_id', $user->id)->firstOrFail();

        $validated = $request->validate([
            'notification_preferences' => 'required|array',
            'notification_preferences.quiz_reminders' => 'required|boolean',
            'notification_preferences.challenge_updates' => 'required|boolean',
            'notification_preferences.achievement_alerts' => 'required|boolean',
            'notification_preferences.weekly_summaries' => 'required|boolean',
            'notification_preferences.marketing_emails' => 'required|boolean',
            'notification_preferences.email_frequency' => 'required|in:daily,three_days,weekly',
            'privacy_settings' => 'required|array',
            'privacy_settings.profile_visibility' => 'required|in:private,public',
            'privacy_settings.share_achievements' => 'required|boolean',
            'privacy_settings.share_progress' => 'required|boolean',
            'data_processing_consents' => 'required|array',
            'data_processing_consents.analytics' => 'required|boolean',
            'data_processing_consents.personalization' => 'required|boolean',
            'data_processing_consents.third_party_sharing' => 'required|boolean',
            'interests' => 'sometimes|array'
        ]);

        // Update user interests if provided
        if ($request->has('interests')) {
            $user->interests = $request->input('interests');
            $user->save();
        }

        $preferences->update($validated);
        $preferences->last_consent_update = now();
        $preferences->save();

        return response()->json($preferences);
    }
}
