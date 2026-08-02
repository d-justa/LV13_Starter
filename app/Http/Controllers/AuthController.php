<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Audits\Models\UserAuditService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Laravel\Socialite\Socialite;

class AuthController extends Controller
{
    public function logout()
    {
        UserAuditService::logout();
        Auth::logout();
        Session::invalidate();
        Session::regenerateToken();
        return to_route('login');
    }

    public function oAuthRedirect(string $provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function oAuthCallback(string $provider)
    {
        $socialUser = Socialite::driver($provider)->user();

        $email = $socialUser->getEmail();

        $user = User::where('email', $email)->first();

        /**
         * IF USER ISN'T PRESENT
         * 1) Create a user (if registration is allowed)
         * 2) Redirect back to login page with error (if registration isn't allowed)
         */
        if (! $user) {
            if (Route::has('register') || true) {
                activity()->disableLogging();

                $name = $socialUser->getName();
                $avatarUrl = $socialUser->getAvatar();

                $user = User::create([
                    'name' => $name,
                    'email' => $email,
                    'password' => Str::random(40)
                ]);
                if ($avatarUrl) {
                    $user->addMediaFromUrl($avatarUrl)->toMediaCollection('avatar');
                }

                activity()->enableLogging();
                UserAuditService::registered($user, $provider);
            } else {
                return to_route('login')->withErrors([
                    'oAuth' => Str::title($provider) . ' Account Not Registered!'
                ]);
            }
        }

        if (! $user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }

        Auth::login($user);
        UserAuditService::login();
        session()->regenerate();
        return to_route('dashboard');
    }
}
