<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AccountPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the authenticated user can access the user account.
     *
     * @param  \App\User  $account
     * @return mixed
     */
    public function access(User $account)
    {
        //
    }

    /**
     * Determine whether the authenticated user can update the user's password.
     *
     * @param  \App\User  $account [account user]
     * @param  \App\User  $user [authenticated user]
     * @return mixed
     */
    public function updateAccount(User $account, User $user)
    {
        return $user->me($account);
    }

}
