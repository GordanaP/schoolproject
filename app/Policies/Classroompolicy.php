<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class Classroompolicy
{
    use HandlesAuthorization;

    public function access(User $user)
    {
        //
    }
}
