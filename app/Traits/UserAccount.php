<?php

namespace App\Traits;

use App\Role;

trait UserAccount
{
    public static function createAccount($fields)
    {
        $user = new static;

        $user->setAccountDetails($user, $fields);

        return $user;
    }

    public static function updateAccount($user, $fields)
    {
        if ($user->isStudent())
        {
            $user->updateStudentAccount($user, $fields);
        }
        elseif ($user->isTeacher())
        {
            $user->updateTeacherAccount($user, $fields);
        }
    }

    public function updatePassword($user, $fields)
    {
        $user->update([
            'password' => bcrypt(password($fields['first_name'], $fields['last_name'], $fields['dob']))
        ]);
    }

    public function createProfile($role, $fields)
    {
        $roles = Role::whereIn('id', $role)->pluck('name')->toArray();

        if(in_array('teacher', $roles))
        {
            $this->teacher()->create($fields);
        }

        if(in_array('student', $roles))
        {
            $this->student()->create($fields);
        }
    }

    public function updateProfile($user, $fields)
    {
        if ($user->isTeacher())
        {
            $user->teacher()->update(
                $this->formFields($user, $fields)
            );
        }
        else
        {
            $user->student()->update(
                array_merge($this->formFields($user, $fields),
                    ['classroom_id' => $fields['classroom_id']]
                )
            );
        }
    }

    public function fullname()
    {
        if ($this->isTeacher())
        {
            return fullname($this->teacher->first_name, $this->teacher->last_name);
        }

        if ($this->isStudent())
        {
            return fullname($this->student->first_name, $this->student->last_name);
        }

        if ($this->isSuperAdmin()) {
           return $this->name;
        }
    }

    protected static function setAccountDetails($user, $fields)
    {
        $user->username = username($fields['first_name'], $fields['last_name']);
        $user->password = bcrypt(password($fields['first_name'], $fields['last_name'], $fields['dob']));
        $user->name = slug_name($fields['first_name'], $fields['last_name']);

        $count = static::whereRaw("name REGEXP '^{$user->name}(-[0-9]*)?$'")->count();

        if($count > 0)
        {
            $latestName = static::whereRaw("name REGEXP '^{$user->name}(-[0-9]*)?$'")
                ->latest('name', 'desc')
                ->pluck('name')
                ->first();

            $pieces = explode('-', $latestName);

            $number = intval(end($pieces));

            $user->name .= '-' .($number + 1);
            $user->email = email($fields['first_name'], $fields['last_name']) .($number + 1) . '@laraschool.com';
        }
        else
        {
            $user->email = email($fields['first_name'], $fields['last_name']) . '@laraschool.com';
        }

        $user->save();
    }

    protected function updateTeacherAccount($user, $fields)
    {
        if ($fields['first_name'] != $user->teacher->first_name || $fields['last_name'] != $user->teacher->last_name)
        {
            $this->setAccountDetails($user, $fields);
        }
        elseif($fields['first_name'] == $user->teacher->first_name && $fields['last_name'] == $user->teacher->last_name && \Carbon\Carbon::parse($fields['dob']) != $user->teacher->dob)
        {
            $this->updatePassword($user, $fields);
        }
    }

    protected function updateStudentAccount($user, $fields)
    {
        if ($fields['first_name'] != $user->student->first_name || $fields['last_name'] != $user->student->last_name)
        {
            $this->setAccountDetails($user, $fields);
        }
        elseif($fields['first_name'] == $user->student->first_name && $fields['last_name'] == $user->student->last_name && \Carbon\Carbon::parse($fields['dob']) != $user->student->dob)
        {
            $this->updatePassword($user, $fields);
        }
    }

    protected function formFields($user, $fields)
    {
        return [
            'first_name' => $fields['first_name'],
            'last_name' => $fields['last_name'],
            'gender' => $fields['gender'],
            'parent' => $fields['parent'],
            'birthplace' => $fields['birthplace'],
            'dob' => $fields['dob'],
            'cwid' => $user->username,
            'about' => $fields['about'],
        ];
    }

}