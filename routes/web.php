<?php

use App\Http\Controllers\Auth\SanctumAuthController;
use App\Http\Controllers\Auth\CsrfCookieController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});




// CSRF cookie route for cross-origin requests
Route::middleware(['api'])->get('/sanctum/csrf-cookie', [CsrfCookieController::class, 'show']);


Route::middleware('web')->group(function () {
    Route::post('/login', [SanctumAuthController::class, 'login'])->name('login');
    Route::post('/logout', [SanctumAuthController::class, 'logout'])->middleware('auth:sanctum');
});

