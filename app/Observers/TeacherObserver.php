<?php

namespace App\Observers;

use App\Teacher;
use App\User;

class TeacherObserver
{
    public function creating(Teacher $teacher)
    {
        $user = User::where('id', $teacher->user_id)->first();

        $teacher->slug = $user->name;
    }
}