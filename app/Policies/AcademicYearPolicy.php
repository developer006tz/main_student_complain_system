<?php

namespace App\Policies;

use App\Models\User;
use App\Models\AcademicYear;
use Illuminate\Auth\Access\HandlesAuthorization;

class AcademicYearPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the academicYear can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list academicyears');
    }

    /**
     * Determine whether the academicYear can view the model.
     */
    public function view(User $user, AcademicYear $model): bool
    {
        return $user->hasPermissionTo('view academicyears');
    }

    /**
     * Determine whether the academicYear can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create academicyears');
    }

    /**
     * Determine whether the academicYear can update the model.
     */
    public function update(User $user, AcademicYear $model): bool
    {
        return $user->hasPermissionTo('update academicyears');
    }

    /**
     * Determine whether the academicYear can delete the model.
     */
    public function delete(User $user, AcademicYear $model): bool
    {
        return $user->hasPermissionTo('delete academicyears');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete academicyears');
    }

    /**
     * Determine whether the academicYear can restore the model.
     */
    public function restore(User $user, AcademicYear $model): bool
    {
        return false;
    }

    /**
     * Determine whether the academicYear can permanently delete the model.
     */
    public function forceDelete(User $user, AcademicYear $model): bool
    {
        return false;
    }
}
