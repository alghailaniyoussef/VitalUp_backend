<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class AdminQuizController extends Controller
{
    /**
     * Get all quizzes with pagination
     */
    public function getQuizzes(Request $request): JsonResponse
    {
        $perPage = $request->input('per_page', 15);
        $locale = $request->input('locale');
        
        $query = Quiz::query();
        
        if ($locale) {
            $query->where('locale', $locale);
        }
        
        $quizzes = $query->paginate($perPage);
        
        // Decode questions JSON for each quiz
        $quizzes->getCollection()->transform(function ($quiz) {
            if (is_string($quiz->questions)) {
                $quiz->questions = json_decode($quiz->questions, true) ?: [];
            }
            return $quiz;
        });
        
        return response()->json($quizzes);
    }

    /**
     * Create a new quiz
     */
    public function createQuiz(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'questions' => 'required|array',
            'points_per_question' => 'required|integer|min:1',
            'is_active' => 'boolean',
            'available_from' => 'nullable|date',
            'available_until' => 'nullable|date',
            'locale' => 'required|string|in:en,es'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $quiz = Quiz::create($request->all());
        return response()->json($quiz, 201);
    }

    /**
     * Update an existing quiz
     */
    public function updateQuiz(Request $request, $id): JsonResponse
    {
        $quiz = Quiz::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|nullable|string',
            'questions' => 'sometimes|array',
            'points_per_question' => 'sometimes|integer|min:1',
            'is_active' => 'sometimes|boolean',
            'available_from' => 'sometimes|nullable|date',
            'available_until' => 'sometimes|nullable|date',
            'locale' => 'sometimes|string|in:en,es'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $quiz->update($request->all());
        return response()->json($quiz);
    }

    /**
     * Delete a quiz
     */
    public function deleteQuiz($id): JsonResponse
    {
        $quiz = Quiz::findOrFail($id);
        $quiz->delete();

        return response()->json(null, 204);
    }

    /**
     * Get quiz statistics
     */
    public function getQuizStats(Request $request): JsonResponse
    {
        $locale = $request->input('locale');
        
        $query = Quiz::query();
        if ($locale) {
            $query->where('locale', $locale);
        }
        
        $totalQuizzes = $query->count();
        $activeQuizzes = $query->where('is_active', true)->count();
        
        // Calculate total questions by decoding JSON
        $allQuizzes = $query->get(['questions']);
        $totalQuestions = $allQuizzes->sum(function ($quiz) {
            $questions = is_string($quiz->questions) ? json_decode($quiz->questions, true) : $quiz->questions;
            return is_array($questions) ? count($questions) : 0;
        });
        
        $totalAttempts = $query->sum('attempts_count');
        $averageScore = $query->avg('average_score');

        $quizzesByDifficulty = $query->selectRaw('difficulty, count(*) as count')
            ->groupBy('difficulty')
            ->get();

        $mostPopular = $query->orderBy('attempts_count', 'desc')
            ->limit(5)
            ->get(['id', 'title', 'attempts_count']);

        return response()->json([
            'total_quizzes' => $totalQuizzes,
            'active_quizzes' => $activeQuizzes,
            'total_questions' => $totalQuestions,
            'total_attempts' => $totalAttempts,
            'average_score' => $averageScore,
            'quizzes_by_difficulty' => $quizzesByDifficulty,
            'most_popular' => $mostPopular
        ]);
    }
}
