<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts::auth')] class extends Component
{
    public string $email = '';

    public  function sendResetLink()
    {
        $this->validate([
            'email' => ['required', 'email'],
        ]);

        $status = Password::sendResetLink([
            'email' => $this->email,
        ]);

        if ($status === Password::RESET_LINK_SENT) {
            session()->flash('success', __($status));
            $this->reset('email');
            return;
        }

        $this->addError('email', __($status));
    }
};