<?php

namespace App\Observers;

use App\Student;
use App\User;

class StudentObserver
{
    public function creating(Student $student)
    {
        $user = User::whereId($student->user_id)->first();

        $student->cwid = $user->username;
    }
}