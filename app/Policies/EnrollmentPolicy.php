<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Enrollment;
use Illuminate\Auth\Access\HandlesAuthorization;

class EnrollmentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the enrollment can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list enrollments');
    }

    /**
     * Determine whether the enrollment can view the model.
     */
    public function view(User $user, Enrollment $model): bool
    {
        return $user->hasPermissionTo('view enrollments');
    }

    /**
     * Determine whether the enrollment can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create enrollments');
    }

    /**
     * Determine whether the enrollment can update the model.
     */
    public function update(User $user, Enrollment $model): bool
    {
        return $user->hasPermissionTo('update enrollments');
    }

    /**
     * Determine whether the enrollment can delete the model.
     */
    public function delete(User $user, Enrollment $model): bool
    {
        return $user->hasPermissionTo('delete enrollments');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete enrollments');
    }

    /**
     * Determine whether the enrollment can restore the model.
     */
    public function restore(User $user, Enrollment $model): bool
    {
        return false;
    }

    /**
     * Determine whether the enrollment can permanently delete the model.
     */
    public function forceDelete(User $user, Enrollment $model): bool
    {
        return false;
    }
}
