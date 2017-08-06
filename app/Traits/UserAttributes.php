<?php

namespace App\Traits;

trait UserAttributes
{
    public function getFirstNameAttribute()
    {
        if ($this->isStudent())
        {
            return ucfirst($this->student->first_name);
        }
        elseif ($this->isTeacher())
        {
            return ucfirst($this->teacher->first_name);
        }
    }

    public function getLastNameAttribute()
    {
        if ($this->isStudent())
        {
            return ucfirst($this->student->last_name);
        }
        elseif ($this->isTeacher())
        {
            return ucfirst($this->teacher->last_name);
        }
    }

    public function getBirthplaceAttribute()
    {
        if ($this->isStudent())
        {
            return ucfirst($this->student->birthplace);
        }
        elseif ($this->isTeacher())
        {
            return ucfirst($this->teacher->birthplace);
        }
    }

    public function getParentNameAttribute()
    {
        if ($this->isStudent())
        {
            return ucfirst($this->student->parent);
        }
        elseif ($this->isTeacher())
        {
            return ucfirst($this->teacher->parent);
        }
    }
}