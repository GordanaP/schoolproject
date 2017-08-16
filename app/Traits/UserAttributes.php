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

    public function getFullNameAttribute()
    {
        if ($this->isStudent())
        {
            return ucfirst($this->student->first_name) . ' ' .ucfirst($this->student->last_name);
        }
        elseif ( $this->isTeacher())
        {
            return ucfirst($this->teacher->first_name) . ' ' .ucfirst($this->teacher->last_name);
        }
        else
        {
            return $this->name;
        }
    }

    public function getBirthDateAttribute()
    {
        if ($this->isStudent())
        {
            return $this->student->dob->format('Y-m-d');
        }
        elseif ($this->isTeacher())
        {
            return $this->teacher->dob->format('Y-m-d');
        }
    }

}