<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Semester;
use Illuminate\Auth\Access\HandlesAuthorization;

class SemesterPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the semester can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list semesters');
    }

    /**
     * Determine whether the semester can view the model.
     */
    public function view(User $user, Semester $model): bool
    {
        return $user->hasPermissionTo('view semesters');
    }

    /**
     * Determine whether the semester can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create semesters');
    }

    /**
     * Determine whether the semester can update the model.
     */
    public function update(User $user, Semester $model): bool
    {
        return $user->hasPermissionTo('update semesters');
    }

    /**
     * Determine whether the semester can delete the model.
     */
    public function delete(User $user, Semester $model): bool
    {
        return $user->hasPermissionTo('delete semesters');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete semesters');
    }

    /**
     * Determine whether the semester can restore the model.
     */
    public function restore(User $user, Semester $model): bool
    {
        return false;
    }

    /**
     * Determine whether the semester can permanently delete the model.
     */
    public function forceDelete(User $user, Semester $model): bool
    {
        return false;
    }
}
