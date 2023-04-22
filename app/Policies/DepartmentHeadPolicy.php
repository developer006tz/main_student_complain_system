<?php

namespace App\Policies;

use App\Models\User;
use App\Models\DepartmentHead;
use Illuminate\Auth\Access\HandlesAuthorization;

class DepartmentHeadPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the departmentHead can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list departmentheads');
    }

    /**
     * Determine whether the departmentHead can view the model.
     */
    public function view(User $user, DepartmentHead $model): bool
    {
        return $user->hasPermissionTo('view departmentheads');
    }

    /**
     * Determine whether the departmentHead can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create departmentheads');
    }

    /**
     * Determine whether the departmentHead can update the model.
     */
    public function update(User $user, DepartmentHead $model): bool
    {
        return $user->hasPermissionTo('update departmentheads');
    }

    /**
     * Determine whether the departmentHead can delete the model.
     */
    public function delete(User $user, DepartmentHead $model): bool
    {
        return $user->hasPermissionTo('delete departmentheads');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete departmentheads');
    }

    /**
     * Determine whether the departmentHead can restore the model.
     */
    public function restore(User $user, DepartmentHead $model): bool
    {
        return false;
    }

    /**
     * Determine whether the departmentHead can permanently delete the model.
     */
    public function forceDelete(User $user, DepartmentHead $model): bool
    {
        return false;
    }
}
