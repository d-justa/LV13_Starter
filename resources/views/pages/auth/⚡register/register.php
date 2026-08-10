<?php

use App\Models\User;
use App\Services\Audits\Models\UserAuditService;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts::auth')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function register()
    {
        $data = $this->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed'
        ]);

        activity()->disableLogging();
        $user = User::create($data);
        activity()->enableLogging();
        $user->sendWelcomeNotification();
        session()->flash('success', __('Your account was created successfully. Please login to continue.'));
        UserAuditService::registered($user);
        return to_route('login');
    }
};
