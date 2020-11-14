<?php

namespace App\Policies;

use App\Service;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ServicePolicy
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

    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Service  $service
     * @return mixed
     */
    public function view(User $user, Service $service)
    {
        if(Session::get('roles') === 'root'){
            return true;
        }
        return $user->company_id === $service->company_id;
    }
    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {

    }
    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Service  $service
     * @return mixed
     */
    public function update(User $user, Service $service)
    {
        if(Session::get('roles') === 'root') {
            return true;
        }
        if(Session::get('roles') === 'admin'){
            return $user->company_id === $service->company_id;
        }
        return $user->id === $service->user_id;
    }
    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Service  $service
     * @return mixed
     */
    public function delete(User $user, Service $service)
    {
        if(Session::get('roles') === 'root') {
            return true;
        }
        if(Session::get('roles') === 'admin'){
            return true;
        }
        return $user->id === $service->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Service  $service
     * @return mixed
     */
    public function restore(User $user, Service $service)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Service  $service
     * @return mixed
     */
    public function forceDelete(User $user, Service $service)
    {
        //
    }
}
