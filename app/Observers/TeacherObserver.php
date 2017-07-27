<?php

namespace App\Observers;

use App\Teacher;

class TeacherObserver
{
    public function creating(Teacher $teacher)
    {
        $teacher->slug = strtolower($teacher->first_name) . '-' . strtolower($teacher->last_name) . '-' . random_int(10, 99);
    }

}