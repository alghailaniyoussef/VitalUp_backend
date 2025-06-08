<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Services\TranslationService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class QuizController extends Controller
{
    /**
     * Obtener todos los cuestionarios disponibles para el usuario
     */
    public function index(Request $request): JsonResponse
    {
        $user = Auth::user();
        $locale = $request->header('Accept-Language', 'en');

        $allQuizzes = Quiz::where('is_active', true)
            ->where('locale', $locale)
            ->where(function ($query) {
                $query->whereNull('available_until')
                    ->orWhere('available_until', '>=', now());
            })
            ->where(function ($query) {
                $query->whereNull('available_from')
                    ->orWhere('available_from', '<=', now());
            })
            ->get();

        // Get completed quiz attempts with scores
        $completedAttempts = QuizAttempt::where('user_id', $user->id)
            ->where('completed_at', '!=', null)
            ->get()
            ->keyBy('quiz_id');

        // Get incomplete quiz attempts
        $incompleteAttempts = QuizAttempt::where('user_id', $user->id)
            ->whereNull('completed_at')
            ->get()
            ->keyBy('quiz_id');

        $completedQuizIds = $completedAttempts->pluck('quiz_id')->toArray();
        $incompleteQuizIds = $incompleteAttempts->pluck('quiz_id')->toArray();

        // Helper function to add translations to quiz
        $addTranslations = function ($quiz) use ($locale) {
            // Ensure questions is always an array
            if (is_string($quiz->questions)) {
                $quiz->questions = json_decode($quiz->questions, true) ?? [];
            }

            // Add translated category if available
            if ($quiz->category) {
                $quiz->category_translated = TranslationService::translate('quiz_category', $quiz->category, $locale);
            }

            // Add translated title and description
            $quiz->title_translated = TranslationService::translate('quiz_title', $quiz->title, $locale);
            $quiz->description_translated = TranslationService::translate('quiz_description', $quiz->description, $locale);

            return $quiz;
        };

        // Separate available, incomplete, and completed quizzes
        $availableQuizzes = $allQuizzes->whereNotIn('id', array_merge($completedQuizIds, $incompleteQuizIds))->map($addTranslations)->values();

        $incompleteQuizzes = $allQuizzes->whereIn('id', $incompleteQuizIds)->map(function ($quiz) use ($incompleteAttempts, $addTranslations) {
            $attempt = $incompleteAttempts->get($quiz->id);
            $quiz->current_answers = $attempt->answers;
            $quiz->current_question = count($attempt->answers ?? []);
            return $addTranslations($quiz);
        })->values();

        $completedQuizzes = $allQuizzes->whereIn('id', $completedQuizIds)->map(function ($quiz) use ($completedAttempts, $addTranslations) {
            $attempt = $completedAttempts->get($quiz->id);
            $quiz->score = $attempt->score;
            $quiz->points_earned = $attempt->points_earned;
            $quiz->completed_at = $attempt->completed_at;
            return $addTranslations($quiz);
        })->values();

        return response()->json([
            'available_quizzes' => $availableQuizzes,
            'incomplete_quizzes' => $incompleteQuizzes,
            'completed_quizzes' => $completedQuizzes
        ]);
    }

    /**
     * Obtener un cuestionario específico
     */
    public function show($id, Request $request): JsonResponse
    {
        $user = Auth::user();
        $locale = $request->header('Accept-Language', 'en');
        $quiz = Quiz::where('id', $id)->where('locale', $locale)->firstOrFail();

        // Verificar si el cuestionario está disponible
        if (!$quiz->is_active) {
            return response()->json(['message' => 'Este cuestionario no está disponible'], 403);
        }

        // Verificar restricciones de tiempo
        if ($quiz->available_from && $quiz->available_from > now()) {
            return response()->json(['message' => 'Este cuestionario aún no está disponible'], 403);
        }

        if ($quiz->available_until && $quiz->available_until < now()) {
            return response()->json(['message' => 'Este cuestionario ya no está disponible'], 403);
        }

        // Verificar si ya fue completado
        $completed = QuizAttempt::where('user_id', $user->id)
            ->where('quiz_id', $quiz->id)
            ->where('completed_at', '!=', null)
            ->exists();

        $quiz->completed = $completed;

        // Ensure questions is always an array
        if (is_string($quiz->questions)) {
            $quiz->questions = json_decode($quiz->questions, true) ?? [];
        }

        // Add translated category if available
        if ($quiz->category) {
            $quiz->category_translated = TranslationService::translate('quiz_category', $quiz->category, $locale);
        }

        // Add translated title and description
        $quiz->title_translated = TranslationService::translate('quiz_title', $quiz->title, $locale);
        $quiz->description_translated = TranslationService::translate('quiz_description', $quiz->description, $locale);

        return response()->json($quiz);
    }

    /**
     * Enviar respuestas a un cuestionario
     */
    public function submitAnswers(Request $request, $id): JsonResponse
    {
        $user = Auth::user();
        $quiz = Quiz::findOrFail($id);

        // Debug logging
        \Log::info('Quiz submission request:', [
            'request_data' => $request->all(),
            'has_question_index' => $request->has('question_index'),
            'has_selected_answer' => $request->has('selected_answer'),
            'question_index_value' => $request->get('question_index'),
            'selected_answer_value' => $request->get('selected_answer'),
            'has_answers' => $request->has('answers'),
            'answers_is_array' => is_array($request->get('answers'))
        ]);

        // Determine if this is a single answer submission or full quiz submission
        $questionIndex = $request->get('question_index');
        $selectedAnswer = $request->get('selected_answer');
        $answers = $request->get('answers');

        if (!is_null($questionIndex) && !is_null($selectedAnswer)) {
            // Single answer submission
            $request->validate([
                'question_index' => 'required|integer|min:0',
                'selected_answer' => 'required|integer|min:0'
            ]);

            // Get the question from the quiz
            $questions = $quiz->questions;
            // Ensure questions is an array
            if (is_string($questions)) {
                $questions = json_decode($questions, true) ?? [];
            }

            if (!isset($questions[$questionIndex])) {
                return response()->json(['message' => 'Question not found'], 404);
            }

            $question = $questions[$questionIndex];
            $correct = $selectedAnswer == $question['correct_answer'];
            $pointsEarned = $correct ? ($quiz->points_per_question ?? 10) : 0;

            // Check if user has already completed this quiz
            $completedAttempt = QuizAttempt::where('user_id', $user->id)
                ->where('quiz_id', $quiz->id)
                ->whereNotNull('completed_at')
                ->first();

            if ($completedAttempt) {
                return response()->json(['message' => 'Ya has completado este cuestionario'], 403);
            }

            // Find or create incomplete quiz attempt
            $attempt = QuizAttempt::where('user_id', $user->id)
                ->where('quiz_id', $quiz->id)
                ->whereNull('completed_at')
                ->first();

            if (!$attempt) {
                $attempt = QuizAttempt::create([
                    'user_id' => $user->id,
                    'quiz_id' => $quiz->id,
                    'answers' => [],
                    'score' => 0,
                    'points_earned' => 0,
                    'completed_at' => null
                ]);
            }

            // Add this answer to the attempt
            $currentAnswers = $attempt->answers ?? [];
            $currentAnswers[$questionIndex] = [
                'question_index' => $questionIndex,
                'selected_answer' => $selectedAnswer,
                'correct' => $correct,
                'points_earned' => $pointsEarned
            ];

            $attempt->answers = $currentAnswers;
            $attempt->save();

            return response()->json([
                'correct' => $correct,
                'points_earned' => $pointsEarned,
                'message' => $correct ? 'Correct answer!' : 'Incorrect answer. Try again!'
            ]);
        } elseif (!is_null($answers) && is_array($answers)) {

        // Validar que el cuestionario esté disponible
        if (
            !$quiz->is_active ||
            ($quiz->available_from && $quiz->available_from > now()) ||
            ($quiz->available_until && $quiz->available_until < now())
        ) {
            return response()->json(['message' => 'Este cuestionario no está disponible'], 403);
        }

        // Validar que no haya sido completado anteriormente
        $existingAttempt = QuizAttempt::where('user_id', $user->id)
            ->where('quiz_id', $quiz->id)
            ->where('completed_at', '!=', null)
            ->first();

        if ($existingAttempt) {
            return response()->json(['message' => 'Ya has completado este cuestionario'], 403);
        }

            // Full quiz submission
            $request->validate([
                'answers' => 'required|array'
            ]);

            // Calculate score
            $questions = $quiz->questions;
            // Ensure questions is an array
            if (is_string($questions)) {
                $questions = json_decode($questions, true) ?? [];
            }

            $score = 0;
            $totalQuestions = count($questions);
            $pointsEarned = 0;

            foreach ($answers as $index => $answer) {
                if (isset($questions[$index]) && $answer == $questions[$index]['correct_answer']) {
                    $score++;
                    $pointsEarned += $quiz->points_per_question ?? 10;
                }
            }

            // Find any existing attempt for this quiz (completed or incomplete)
            $attempt = QuizAttempt::where('user_id', $user->id)
                ->where('quiz_id', $quiz->id)
                ->first();

            if (!$attempt) {
                // If no attempt exists at all, create a new one
                $attempt = QuizAttempt::create([
                    'user_id' => $user->id,
                    'quiz_id' => $quiz->id,
                    'answers' => $request->answers,
                    'score' => 0,
                    'points_earned' => 0,
                    'started_at' => now()
                ]);
            } else {
                // Update the existing attempt with new answers
                $attempt->update([
                    'answers' => $request->answers
                ]);
            }

            // Update attempt as completed
            $attempt->update([
                'score' => $score,
                'points_earned' => $pointsEarned,
                'completed_at' => now()
            ]);

            // Store old points for level comparison
        $oldPoints = $user->points;

        // Update user points
        $user->points += $pointsEarned;

        // Calculate and update level
        $newLevel = $user->calculateLevel();
        $user->level = $newLevel;
        $user->save();

        // Check if user leveled up and send notification
        if ($user->hasLeveledUp($oldPoints)) {
            $nextLevelPoints = $user->getPointsForNextLevel();
            app(\App\Services\EmailNotificationService::class)->sendLevelUpNotification($user, $newLevel, $nextLevelPoints);
        }

        // Create points history entry
        \App\Models\UserPointsHistory::createEntry(
            $user->id,
            $pointsEarned,
            'quiz',
            $quiz->id,
            "Completed quiz: {$quiz->title}"
        );

        // Dispatch quiz completed event for email notification
            event(new \App\Events\QuizCompleted($user, $quiz, $score, $totalQuestions, $pointsEarned));

            return response()->json([
                'message' => 'Quiz completed successfully',
                'score' => $score,
                'total_questions' => $totalQuestions,
                'points_earned' => $pointsEarned,
                'user_points' => $user->points,
                'user_level' => $user->calculateLevel()
            ]);
        }

        // If we reach here, it means the request doesn't match expected formats
        return response()->json([
            'message' => 'Invalid request. Please provide either question_index and selected_answer for single submission, or answers array for full quiz submission.'
        ], 400);
    }

    /**
     * Complete a quiz attempt
     */
    public function completeQuiz(Request $request, $id): JsonResponse
    {
        $user = Auth::user();
        $quiz = Quiz::findOrFail($id);

        // Find the incomplete attempt
        $attempt = QuizAttempt::where('user_id', $user->id)
            ->where('quiz_id', $quiz->id)
            ->whereNull('completed_at')
            ->first();

        if (!$attempt) {
            // If no incomplete attempt exists, create a new one
            $attempt = QuizAttempt::create([
                'user_id' => $user->id,
                'quiz_id' => $quiz->id,
                'answers' => [],
                'score' => 0,
                'points_earned' => 0,
                'started_at' => now()
            ]);
        }

        // Calculate final score
        $answers = $attempt->answers ?? [];
        $questions = $quiz->questions;
        // Ensure questions is an array
        if (is_string($questions)) {
            $questions = json_decode($questions, true) ?? [];
        }

        $score = 0;
        $totalQuestions = count($questions);

        foreach ($questions as $index => $question) {
            if (isset($answers[$index]) && isset($answers[$index]['selected_answer']) && $answers[$index]['selected_answer'] == $question['correct_answer']) {
                $score++;
            }
        }

        // Calculate points earned
        $pointsEarned = $score * $quiz->points_per_question;

        // Update attempt as completed
        $attempt->update([
            'score' => $score,
            'points_earned' => $pointsEarned,
            'completed_at' => now()
        ]);

        // Store old points for level comparison
        $oldPoints = $user->points;

        // Update user points
        $user->points += $pointsEarned;

        // Calculate and update level
        $newLevel = $user->calculateLevel();
        $user->level = $newLevel;
        $user->save();

        // Check if user leveled up and send notification
        if ($user->hasLeveledUp($oldPoints)) {
            $nextLevelPoints = $user->getPointsForNextLevel();
            app(\App\Services\EmailNotificationService::class)->sendLevelUpNotification($user, $newLevel, $nextLevelPoints);
        }

        // Create points history entry
        \App\Models\UserPointsHistory::createEntry(
            $user->id,
            $pointsEarned,
            'quiz',
            $quiz->id,
            "Completed quiz: {$quiz->title}"
        );

        // Dispatch quiz completed event for email notification
        event(new \App\Events\QuizCompleted($user, $quiz, $score, $totalQuestions, $pointsEarned));

        return response()->json([
            'message' => 'Quiz completed successfully',
            'score' => $score,
            'total_questions' => $totalQuestions,
            'points_earned' => $pointsEarned,
            'user_points' => $user->points,
            'user_level' => $user->calculateLevel()
        ]);
    }

    /**
     * Obtener historial de intentos de cuestionarios del usuario
     */
    public function history(): JsonResponse
    {
        $user = Auth::user();
        $attempts = QuizAttempt::with('quiz')
            ->where('user_id', $user->id)
            ->where('completed_at', '!=', null)
            ->orderBy('completed_at', 'desc')
            ->get();

        return response()->json($attempts);
    }
}
