<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Lecture;
use Illuminate\Auth\Access\HandlesAuthorization;

class LecturePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the lecture can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list lectures');
    }

    /**
     * Determine whether the lecture can view the model.
     */
    public function view(User $user, Lecture $model): bool
    {
        return $user->hasPermissionTo('view lectures');
    }

    /**
     * Determine whether the lecture can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create lectures');
    }

    /**
     * Determine whether the lecture can update the model.
     */
    public function update(User $user, Lecture $model): bool
    {
        return $user->hasPermissionTo('update lectures');
    }

    /**
     * Determine whether the lecture can delete the model.
     */
    public function delete(User $user, Lecture $model): bool
    {
        return $user->hasPermissionTo('delete lectures');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete lectures');
    }

    /**
     * Determine whether the lecture can restore the model.
     */
    public function restore(User $user, Lecture $model): bool
    {
        return false;
    }

    /**
     * Determine whether the lecture can permanently delete the model.
     */
    public function forceDelete(User $user, Lecture $model): bool
    {
        return false;
    }
}
