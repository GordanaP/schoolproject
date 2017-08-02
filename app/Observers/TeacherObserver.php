<?php

namespace App\Observers;

use App\Teacher;
use App\User;

class TeacherObserver
{
    public function creating(Teacher $teacher)
    {
        $user = User::whereId($teacher->user_id)->first();

        $teacher->cwid = $user->username;
    }
}