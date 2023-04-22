<?php

namespace App\Policies;

use App\Models\User;
use App\Models\NtaLevel;
use Illuminate\Auth\Access\HandlesAuthorization;

class NtaLevelPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the ntaLevel can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list ntalevels');
    }

    /**
     * Determine whether the ntaLevel can view the model.
     */
    public function view(User $user, NtaLevel $model): bool
    {
        return $user->hasPermissionTo('view ntalevels');
    }

    /**
     * Determine whether the ntaLevel can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create ntalevels');
    }

    /**
     * Determine whether the ntaLevel can update the model.
     */
    public function update(User $user, NtaLevel $model): bool
    {
        return $user->hasPermissionTo('update ntalevels');
    }

    /**
     * Determine whether the ntaLevel can delete the model.
     */
    public function delete(User $user, NtaLevel $model): bool
    {
        return $user->hasPermissionTo('delete ntalevels');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete ntalevels');
    }

    /**
     * Determine whether the ntaLevel can restore the model.
     */
    public function restore(User $user, NtaLevel $model): bool
    {
        return false;
    }

    /**
     * Determine whether the ntaLevel can permanently delete the model.
     */
    public function forceDelete(User $user, NtaLevel $model): bool
    {
        return false;
    }
}
