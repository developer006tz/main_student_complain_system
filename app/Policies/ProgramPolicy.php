<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Program;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProgramPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the program can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list programs');
    }

    /**
     * Determine whether the program can view the model.
     */
    public function view(User $user, Program $model): bool
    {
        return $user->hasPermissionTo('view programs');
    }

    /**
     * Determine whether the program can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create programs');
    }

    /**
     * Determine whether the program can update the model.
     */
    public function update(User $user, Program $model): bool
    {
        return $user->hasPermissionTo('update programs');
    }

    /**
     * Determine whether the program can delete the model.
     */
    public function delete(User $user, Program $model): bool
    {
        return $user->hasPermissionTo('delete programs');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete programs');
    }

    /**
     * Determine whether the program can restore the model.
     */
    public function restore(User $user, Program $model): bool
    {
        return false;
    }

    /**
     * Determine whether the program can permanently delete the model.
     */
    public function forceDelete(User $user, Program $model): bool
    {
        return false;
    }
}
