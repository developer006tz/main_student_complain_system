<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ComplainType;
use Illuminate\Auth\Access\HandlesAuthorization;

class ComplainTypePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the complainType can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list complaintypes');
    }

    /**
     * Determine whether the complainType can view the model.
     */
    public function view(User $user, ComplainType $model): bool
    {
        return $user->hasPermissionTo('view complaintypes');
    }

    /**
     * Determine whether the complainType can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create complaintypes');
    }

    /**
     * Determine whether the complainType can update the model.
     */
    public function update(User $user, ComplainType $model): bool
    {
        return $user->hasPermissionTo('update complaintypes');
    }

    /**
     * Determine whether the complainType can delete the model.
     */
    public function delete(User $user, ComplainType $model): bool
    {
        return $user->hasPermissionTo('delete complaintypes');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete complaintypes');
    }

    /**
     * Determine whether the complainType can restore the model.
     */
    public function restore(User $user, ComplainType $model): bool
    {
        return false;
    }

    /**
     * Determine whether the complainType can permanently delete the model.
     */
    public function forceDelete(User $user, ComplainType $model): bool
    {
        return false;
    }
}
