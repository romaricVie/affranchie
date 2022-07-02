<?php

namespace App\Policies;

use App\Models\Priere;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class PrierePolicy
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
     * @param  \App\Models\Priere  $priere
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Priere $priere)
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
     * @param  \App\Models\Priere  $priere
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Priere $priere)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Priere  $priere
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Priere $priere)
    {
        //
        return ($user->id === $priere->user->id || $user->hasAnyRoles(['superAdministrateur','administrateur','moderateur']))
                   ? Response::allow()
                   : Response::deny('You do not own this post.');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Priere  $priere
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Priere $priere)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Priere  $priere
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Priere $priere)
    {
        //
    }
}
