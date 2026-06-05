<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::post('/sessions', [DashboardController::class, 'store'])->name('sessions.store');
    Route::put('/sessions/{studySession}', [DashboardController::class, 'update'])->name('sessions.update');
    Route::delete('/sessions/{studySession}', [DashboardController::class, 'destroy'])->name('sessions.destroy');
    Route::post('/sessions/{studySession}/join', [DashboardController::class, 'join'])->name('sessions.join');

    Route::post('/help-requests', [DashboardController::class, 'storeHelpRequest'])->name('help-requests.store');
    Route::put('/help-requests/{helpRequest}', [DashboardController::class, 'updateHelpRequest'])->name('help-requests.update');
    Route::delete('/help-requests/{helpRequest}', [DashboardController::class, 'destroyHelpRequest'])->name('help-requests.destroy');
});
