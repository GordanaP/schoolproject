<?php

namespace App\Observers;

use App\Student;

class StudentObserver
{
    public function creating(Student $student)
    {
        $student->slug = strtolower($student->first_name) . '-' . strtolower($student->last_name) . '-' . random_int(100, 999);
    }
}