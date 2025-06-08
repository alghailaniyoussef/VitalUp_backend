<?php

namespace App\Http\Controllers;

use App\Models\Tip;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class AdminTipController extends Controller
{
    /**
     * Get all tips with pagination
     */
    public function getTips(Request $request): JsonResponse
    {
        $perPage = $request->input('per_page', 15);
        $tips = Tip::orderBy('created_at', 'desc')->paginate($perPage);
        
        return response()->json($tips);
    }

    /**
     * Create a new tip
     */
    public function createTip(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|string|max:100',
            'icon' => 'nullable|string|max:100',
            'is_active' => 'boolean',
            'locale' => 'required|in:en,es',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $tip = Tip::create($validator->validated());

        return response()->json([
            'message' => 'Tip created successfully',
            'tip' => $tip
        ], 201);
    }

    /**
     * Update an existing tip
     */
    public function updateTip(Request $request, $id): JsonResponse
    {
        $tip = Tip::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|string|max:255',
            'content' => 'sometimes|string',
            'category' => 'sometimes|string|max:100',
            'icon' => 'sometimes|nullable|string|max:100',
            'is_active' => 'sometimes|boolean',
            'locale' => 'sometimes|in:en,es',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $tip->update($validator->validated());

        return response()->json([
            'message' => 'Tip updated successfully',
            'tip' => $tip
        ]);
    }

    /**
     * Delete a tip
     */
    public function deleteTip($id): JsonResponse
    {
        $tip = Tip::findOrFail($id);
        $tip->delete();

        return response()->json([
            'message' => 'Tip deleted successfully'
        ]);
    }

    /**
     * Get tip statistics
     */
    public function getTipStats(): JsonResponse
    {
        $totalTips = Tip::count();
        $activeTips = Tip::where('is_active', true)->count();
        $tipsByCategory = Tip::select('category', DB::raw('count(*) as count'))
            ->groupBy('category')
            ->get();
        $tipsByLocale = Tip::select('locale', DB::raw('count(*) as count'))
            ->groupBy('locale')
            ->get();

        return response()->json([
            'total_tips' => $totalTips,
            'active_tips' => $activeTips,
            'tips_by_category' => $tipsByCategory,
            'tips_by_locale' => $tipsByLocale
        ]);
    }
}