<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the authenticated user can access the role.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function access(User $user)
    {
        //
    }
}