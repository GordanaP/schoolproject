<?php

namespace App;

use App\User;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getRouteKeyName()
    {
        return 'name';
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function student()
    {
        return $this->hasOne(Student::class);
    }

    public function teacher()
    {
        return $this->hasOne(Teacher::class);
    }

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

        //$role is a collection
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

    public function owns($related)
    {
        return $this->id == $related->user_id;
    }

    public function me(User $user)
    {
        return $this->id == $user->id;
    }

}