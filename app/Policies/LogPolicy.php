<?php

namespace App\Policies;

use App\Log;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LogPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any logs.
     * index
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the log.
     * show
     * @param  \App\User  $user
     * @param  \App\Log  $log
     * @return mixed
     */
    public function view(User $user, Log $log)
    {
        //
    }

    /**
     * Determine whether the user can create logs.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
        return true;
    }

    /**
     * Determine whether the user can update the log.
     *
     * @param  \App\User  $user
     * @param  \App\Log  $log
     * @return mixed
     */
    public function update(User $user, Log $log)
    {
        return $user->id == $log->user->id;
    }

    /**
     * Determine whether the user can delete the log.
     *
     * @param  \App\User  $user
     * @param  \App\Log  $log
     * @return mixed
     */
    public function delete(User $user, Log $log)
    {
        return $user->id == $log->user->id;
    }

    /**
     * Determine whether the user can restore the log.
     *
     * @param  \App\User  $user
     * @param  \App\Log  $log
     * @return mixed
     */
    public function restore(User $user, Log $log)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the log.
     *
     * @param  \App\User  $user
     * @param  \App\Log  $log
     * @return mixed
     */
    public function forceDelete(User $user, Log $log)
    {
        //
    }
}
