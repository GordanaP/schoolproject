<?php

namespace App\Observers;

use App\User;
use Illuminate\Http\Request;

class UserObserver
{
    public function creating(Request $request, User $user)
    {
        $f_name_init = strtolower(substr($request->first_name, 0, 1));
        $l_name_init = strtolower(substr($request->last_name, 0, 1));
        $n = random_int(1000, 9999);

        $user->name = $f_name_init . $l_name_init .$n;
    }
}