<?php

namespace App\Policies;

use App\User;
use App\warrantyDetails;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Session;

class WarrantyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\warrantyDetails  $warrantyDetails
     * @return mixed
     */
    public function view(User $user, warrantyDetails $warrantyDetails)
    {
        if(Session::get('roles') === 'root'){
            return true;
        }
        return $user->company_id === $warrantyDetails->company_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
      //
    }
    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\warrantyDetails  $warrantyDetails
     * @return mixed
     */
    public function update(User $user, warrantyDetails $warrantyDetails)
    {
        if(Session::get('roles') === 'root') {
            return true;
        }
        if(Session::get('roles') === 'admin'){
            return $user->company_id === $warrantyDetails->company_id;
        }
            return $user->id === $warrantyDetails->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\warrantyDetails  $warrantyDetails
     * @return mixed
     */
    public function delete(User $user, warrantyDetails $warrantyDetails)
    {

    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\warrantyDetails  $warrantyDetails
     * @return mixed
     */
    public function restore(User $user, warrantyDetails $warrantyDetails)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\warrantyDetails  $warrantyDetails
     * @return mixed
     */
    public function forceDelete(User $user, warrantyDetails $warrantyDetails)
    {
        //
    }
}
