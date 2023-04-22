<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Complaint;
use Illuminate\Auth\Access\HandlesAuthorization;

class ComplaintPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the complaint can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list complaints');
    }

    /**
     * Determine whether the complaint can view the model.
     */
    public function view(User $user, Complaint $model): bool
    {
        return $user->hasPermissionTo('view complaints');
    }

    /**
     * Determine whether the complaint can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create complaints');
    }

    /**
     * Determine whether the complaint can update the model.
     */
    public function update(User $user, Complaint $model): bool
    {
        return $user->hasPermissionTo('update complaints');
    }

    /**
     * Determine whether the complaint can delete the model.
     */
    public function delete(User $user, Complaint $model): bool
    {
        return $user->hasPermissionTo('delete complaints');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete complaints');
    }

    /**
     * Determine whether the complaint can restore the model.
     */
    public function restore(User $user, Complaint $model): bool
    {
        return false;
    }

    /**
     * Determine whether the complaint can permanently delete the model.
     */
    public function forceDelete(User $user, Complaint $model): bool
    {
        return false;
    }
}
