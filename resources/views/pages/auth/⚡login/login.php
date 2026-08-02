<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts::auth')] class extends Component
{
    public string $email = '';
    public string $password = '';
    public bool $remember = false;

    public string $otp = '';

    public function login()
    {
        $credentials = $this->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        if(!Auth::attempt($credentials, $this->remember)) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed')
            ]);
        }

        session()->regenerate();

        return redirect()->intended(route('dashboard'));
    }

    public function sendOtp()
    {
        $this->validate([
            'email' => ['required', 'exists:users,email']
        ], [
            'email.exists' => "We couldn't find an account associated with this email address."
        ]);

        $user = User::where('email', $this->email)->first();
        $user->sendOneTimePassword();

        $this->modal('login-otp')->show();
    }

    public function verifyOtp()
    {
        $this->validate([
            'otp' => ['required']
        ]);

        $user = User::where('email', $this->email)->first();

        $result = $user->attemptLoginUsingOneTimePassword($this->otp, remember: false);

        if ($result->isOk()) {
            request()->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return $this->addError('otp', $result->validationMessage());
    }
};
