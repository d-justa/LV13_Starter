<?php

namespace App\Services\Audits\Models;

use App\Models\User;

class UserAuditService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function registered(User $user, ?string $provider = null)
    {
        return activity()
            ->performedOn($user)
            ->causedBy($user)
            ->withProperties([
                'provider' => $provider
            ])
            ->event('user.registered')
            ->log($provider ? 'New User Registered using Social Login' : 'New User Registered');
    }
}
