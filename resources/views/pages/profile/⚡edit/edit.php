<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Spatie\Activitylog\Models\Activity;

new class extends Component
{
    public User $user;

    public string $name = '';
    public string $email = '';

    public string $old_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    public string $current_password = '';

    public function mount()
    {
        $this->user = Auth::user();
        $this->fill($this->user);
    }

    public function update()
    {
        $data = $this->validate([
            'name' => ['required', 'string'],
        ]);

        $this->user->update($data);

        $activity = Activity::latest()->first();
        $activity->update([
            'event' => 'user.profile.updated',
            'description' => 'User Profile Updated'
        ]);
    }

    public function updatePassword()
    {
        $this->validate([
            'old_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $this->user->update([
            'password' => $this->password,
        ]);

        $this->reset([
            'old_password',
            'password',
            'password_confirmation',
        ]);
    }

    public function deleteUser(): void
    {
        $this->authorize('delete', $this->user);
        
        $this->validate([
            'current_password' => ['required', 'current_password'],
        ]);

        Auth::logout();

        DB::transaction(function () {
            // Delete any related data if required
            // $user->favorites()->detach();
            // $user->properties()->delete();
            // ...

            $this->user->delete();
        });

        session()->invalidate();
        session()->regenerateToken();

        $this->redirect('/', navigate: true);
    }
};
