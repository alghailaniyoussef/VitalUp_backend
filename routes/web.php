<?php

use App\Http\Controllers\Auth\SanctumAuthController;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Http\Controllers\CsrfCookieController;

Route::get('/', function () {
    return view('welcome');
});




Route::middleware('web')->get('/sanctum/csrf-cookie', [CsrfCookieController::class, 'show']);


Route::middleware('web')->group(function () {
    Route::post('/login', [SanctumAuthController::class, 'login'])->name('login');
    Route::post('/logout', [SanctumAuthController::class, 'logout'])->middleware('auth:sanctum');
});

