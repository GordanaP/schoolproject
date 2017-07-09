<?php

namespace App\Observers;

use App\Student;
use App\User;

class StudentObserver
{
    public function creating(Student $student)
    {
        $user = User::where('id', $student->user_id)->first();

        $student->slug = $user->name;

    }
}