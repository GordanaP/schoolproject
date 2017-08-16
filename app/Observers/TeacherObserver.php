<?php

namespace App\Observers;

use App\Teacher;

class TeacherObserver
{
    public function creating(Teacher $teacher)
    {
        $teacher->cwid = $teacher->user->username;
    }
}