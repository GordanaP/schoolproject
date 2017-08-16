<?php

namespace App\Observers;

use App\Student;

class StudentObserver
{
    public function creating(Student $student)
    {
        $student->cwid = $student->user->username;
    }
}