<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        return ($user == $model || $user->hasRole('super-admin')) // User can only delete their profile or super-admin can delete any user
            && !$model->hasRole('super-admin') // Super-admins can't be deleted
            && true; // Allow Delete feature?
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can impersonate the model.
     */
    public function impersonate(User $user, User $model): bool
    {
        return !$model->hasRole('super-admin') // Super admins cannot be impersonated
            && $user->id != $model->id // User can't impersonate itself
            && $user->hasRole('super-admin') // Only super-admins can impersonate other users
            && true;
    }
}
