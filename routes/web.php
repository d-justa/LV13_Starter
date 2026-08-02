<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

/**
 * ---------------------------
 * WEBSITE / GUEST ROUTES
 * ---------------------------
 */
Route::get('/', function () {
    return view('welcome');
});


/**
 * -----------------------------
 * BACKEND ROUTES
 * -----------------------------
 */
Route::middleware('auth')->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::livewire('/profile', 'pages::profile.edit')->name('profile.edit');

    // Activity Logs / Audit
    Route::livewire('/audits/{activity}', 'pages::audit.show')->name('audits.show');
});


/**
 * -----------------------------
 * AUTHENTICATION ROUTES
 * -----------------------------
 */
Route::middleware('guest')->group(function () {
    Route::livewire('/login', 'pages::auth.login')->name('login');

    // OAuth Routes
    Route::get('/auth/redirect/{provider}', [AuthController::class, 'oAuthRedirect'])->name('oAuthRedirect');
    Route::get('/auth/callback/{provider}', [AuthController::class, 'oAuthCallback'])->name('oAuthCallback');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
