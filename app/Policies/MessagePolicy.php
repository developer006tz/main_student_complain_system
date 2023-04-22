<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Message;
use Illuminate\Auth\Access\HandlesAuthorization;

class MessagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the message can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list messages');
    }

    /**
     * Determine whether the message can view the model.
     */
    public function view(User $user, Message $model): bool
    {
        return $user->hasPermissionTo('view messages');
    }

    /**
     * Determine whether the message can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create messages');
    }

    /**
     * Determine whether the message can update the model.
     */
    public function update(User $user, Message $model): bool
    {
        return $user->hasPermissionTo('update messages');
    }

    /**
     * Determine whether the message can delete the model.
     */
    public function delete(User $user, Message $model): bool
    {
        return $user->hasPermissionTo('delete messages');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete messages');
    }

    /**
     * Determine whether the message can restore the model.
     */
    public function restore(User $user, Message $model): bool
    {
        return false;
    }

    /**
     * Determine whether the message can permanently delete the model.
     */
    public function forceDelete(User $user, Message $model): bool
    {
        return false;
    }
}
