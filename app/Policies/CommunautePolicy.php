<?php

namespace App\Policies;

use App\Models\Communaute;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
class CommunautePolicy
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
     * @param  \App\Models\Communaute  $communaute
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Communaute $communaute)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Communaute  $communaute
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Communaute $communaute)
    {
        //
         return ($user->id === $communaute->user->id || $user->hasAnyRoles(['superAdministrateur','administrateur','moderateur']))
                       ? Response::allow()
                       : Response::deny('You do not own this post.');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Communaute  $communaute 
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Communaute $communaute)
    {
        //
        return ($user->id === $communaute->user->id || $user->hasAnyRoles(['superAdministrateur','administrateur','moderateur']))
                        ? Response::allow()
                        : Response::deny('You do not own this post.');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Communaute  $communaute
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Communaute $communaute)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Communaute  $communaute
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Communaute $communaute)
    {
        //
    }
}
