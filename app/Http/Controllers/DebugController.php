<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

class DebugController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // Log detailed information about the request and middleware
        Log::info('Debug controller invoked', [
            'user' => $request->user(),
            'is_admin' => $request->user() ? $request->user()->is_admin : null,
            'middleware' => Route::current()->middleware(),
            'route' => Route::current()->uri(),
            'method' => $request->method(),
            'headers' => $request->headers->all(),
            'session' => $request->session()->all()
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Debug information logged',
            'user' => $request->user(),
            'is_admin' => $request->user() ? $request->user()->is_admin : null,
            'middleware' => Route::current()->middleware(),
            'route' => Route::current()->uri(),
            'registered_middleware' => app()->make('router')->getMiddleware()
        ]);
    }

    /**
     * Test admin middleware directly
     */
    public function testAdminMiddleware(Request $request)
    {
        Log::info('Admin middleware test route accessed', [
            'user' => $request->user(),
            'is_admin' => $request->user() ? $request->user()->is_admin : null
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Admin middleware test passed',
            'user' => $request->user(),
            'is_admin' => $request->user() ? $request->user()->is_admin : null
        ]);
    }
}
