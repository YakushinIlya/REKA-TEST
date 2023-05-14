<?php

namespace App\Policies;

use App\Models\TodoAccessPermissions;
use App\Models\Todolists;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class TodolistsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Todolists  $todolists
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Todolists $todolists, int $idPermission)
    {
        if($user->id == $todolists->author){
            return true;
        }

        $TodoAccessPermissions = TodoAccessPermissions::whereRaw('user_id=? && todo_id=? && permission_id=?', [$user->id, $todolists->id, $idPermission])->exists();
        if($TodoAccessPermissions){
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Todolists  $todolists
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Todolists $todolists)
    {
        if($user->id == $todolists->author){
            return true;
        }

        $TodoAccessPermissions = TodoAccessPermissions::whereRaw('user_id=? && todo_id=? && permission_id=?', [$user->id, $todolists->id, 2])->exists();
        if($TodoAccessPermissions){
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Todolists  $todolists
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Todolists $todolists)
    {
        if($user->id == $todolists->author){
            return true;
        }

        $TodoAccessPermissions = TodoAccessPermissions::whereRaw('user_id=? && todo_id=? && permission_id=?', [$user->id, $todolists->id, 3])->exists();
        if($TodoAccessPermissions){
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Todolists  $todolists
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Todolists $todolists)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Todolists  $todolists
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Todolists $todolists)
    {
        //
    }
}
