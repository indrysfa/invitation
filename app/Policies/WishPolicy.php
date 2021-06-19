<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Wish;
use Illuminate\Auth\Access\HandlesAuthorization;

class WishPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Wish  $wish
     * @return mixed
     */
    public function view(User $user, Wish $wish)
    {
        return in_array($user->role, ['admin', 'user']);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Wish  $wish
     * @return mixed
     */
    public function update(User $user)
    {
        return in_array($user->role, ['admin', 'user']);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Wish  $wish
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Wish  $wish
     * @return mixed
     */
    public function restore(User $user, Wish $wish)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Wish  $wish
     * @return mixed
     */
    public function forceDelete(User $user, Wish $wish)
    {
        //
    }
}
