<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ImpersonationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

/**
 * ---------------------------
 * WEBSITE / GUEST ROUTES
 * ---------------------------
 */
Route::name('website.')->group(function() {
    Route::livewire('/', 'website::home')->name('home');
});


/**
 * -----------------------------
 * BACKEND ROUTES
 * -----------------------------
 */
Route::middleware('auth')->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::livewire('/profile', 'pages::profile.edit')->name('profile.edit');

    //
    Route::view('/users', 'pages.users.index')->name('users.index');

    // Activity Logs / Audit
    Route::view('/audits', 'pages.audit.index')->name('audit.index');
    Route::livewire('/audits/{activity}', 'pages::audit.show')->name('audits.show');
});


/**
 * -----------------------------
 * AUTHENTICATION ROUTES
 * -----------------------------
 */
Route::middleware('guest')->group(function () {
    Route::livewire('/login', 'pages::auth.login')->name('login');
    Route::livewire('/forgot-password', 'pages::auth.forgot-password')->name('password.request');
    Route::livewire('/reset-password/{token}', 'pages::auth.reset-password')->name('password.reset');

    // Register - Comment this if application doesn't allow registration of new users
    Route::livewire('/register', 'pages::auth.register')->name('register');

    // OAuth Routes
    Route::get('/auth/redirect/{provider}', [AuthController::class, 'oAuthRedirect'])->name('oAuthRedirect');
    Route::get('/auth/callback/{provider}', [AuthController::class, 'oAuthCallback'])->name('oAuthCallback');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Impersonation
    Route::post('/users/{user}/impersonate', [ImpersonationController::class, 'start'])->name('impersonation.start');
    Route::post('/impersonation/stop', [ImpersonationController::class, 'stop'])->name('impersonation.stop');
});
