<?php

namespace App\Traits;

use App\Role;

trait UserRoles
{
    /**
     * An authenticated user has one or multiple roles.
     *
     * @param  string or coll  $role
     * @return boolean
     */
    public function hasRole($role)
    {
        //$role is a string
        if (is_string($role))
        {
            return $this->roles->contains('name', $role);
        }

        //$role is int
        return (bool) $role->intersect($this->roles)->count();
    }

    public function isAdmin()
    {
        return $this->hasRole('admin');
    }

    public function isStudent()
    {
        return $this->hasRole('student');
    }

    public function isTeacher()
    {
        return $this->hasRole('teacher');
    }

    public function isSuperAdmin()
    {
        return $this->hasRole('superadmin');
    }

    public function assignRole($role)
    {
        $roles = Role::whereIn('id', $role)->get();

        $this->hasRole($roles) ? $this->roles()->sync($role) : $this->roles()->attach($role);
    }

}