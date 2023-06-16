<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicies
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('show_users');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {

        return  $user->hasPermissionTo('show_users') && $user->isNot($model);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return  $user->hasPermissionTo('create_users');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        return  $user->hasPermissionTo('edit_users') && $user->isNot($model);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        return  $user->hasPermissionTo('delete_users') && $user->isNot($model);
    }

    public function forceDelete(User $user, User $model) : bool{
        return  $user->hasPermissionTo('delete_users') && $user->isNot($model);
    }
}
