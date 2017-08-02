<?php

namespace App;

use App\Role;
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
        'name', 'email', 'password', 'username'
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

    public function me($user)
    {
        return $this->id === $user->id;
    }

    public function assignRole($role)
    {
        $roles = Role::whereIn('id', $role)->get();

        $this->hasRole($roles) ? $this->roles()->sync($role) : $this->roles()->attach($role);
    }

    public function createProfile($user, $role, $fields)
    {
        $roles = Role::whereIn('id', $role)->pluck('name')->toArray();

        if(in_array('teacher', $roles))
        {
            $this->teacher()->create($fields);
        }

        if(in_array('student', $roles))
        {
            $this->student()->create([
                'first_name' => $fields['first_name'],
                'last_name' => $fields['last_name'],
                'dob' => $fields['dob'],
                'cwid' => $user->username
            ]);
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

    public static function createAccount($fields)
    {
        return static::create([
            'name' => slug($fields['first_name'], $fields['last_name']),
            'username' => username($fields['first_name'], $fields['last_name']),
            'email' => email($fields['first_name'], $fields['last_name']),
            'password' => bcrypt(password($fields['first_name'], $fields['last_name'], $fields['dob']))
        ]);
    }

    public function updateAccount($user, $fields)
    {
        $teacher = Role::where('name', 'teacher')->first();
        $student = Role::where('name', 'student')->first();

        if (in_array($teacher->id, $fields['role_id']))
        {
            $this->updateTeacherAccount($user, $fields);
        }
        else
        {
            $this->updateStudentAccount($user, $fields);
        }
    }

    public function updateProfile($user, $fields)
    {
        if ($user->isTeacher())
        {
            $user->teacher()->update([
                'first_name' => $fields['first_name'],
                'last_name' => $fields['last_name'],
                'dob' => $fields['dob'],
                'cwid' => $user->username
            ]);
        }
        else
        {
            $user->student()->update([
                'first_name' => $fields['first_name'],
                'last_name' => $fields['last_name'],
                'dob' => $fields['dob'],
                'cwid' => $user->username
            ]);
        }
    }

    public function updateTeacherAccount($user, $fields)
    {
        if ($fields['first_name'] != $user->teacher->first_name || $fields['last_name'] != $user->teacher->last_name)
        {
            $this->updateUser($user, $fields);
        }
        elseif($fields['first_name'] == $user->teacher->first_name && $fields['last_name'] == $user->teacher->last_name && $fields['dob'] != $user->teacher->dob)
        {
            $this->updatePassword($user, $fields);
        }
    }

    public function updateStudentAccount($user, $fields)
    {
        if ($fields['first_name'] != $user->student->first_name || $fields['last_name'] != $user->student->last_name)
        {
            $this->updateUser($user, $fields);
        }
        elseif($fields['first_name'] == $user->student->first_name && $fields['last_name'] == $user->student->last_name && $fields['dob'] != $user->student->dob)
        {
            $this->updatePassword($user, $fields);
        }
    }

    public function updateUser($user, $fields)
    {
        $first_name = $fields['first_name'];
        $last_name = $fields['last_name'];
        $dob = $fields['dob'];

        $user->update([
            'name' => slug($first_name, $last_name),
            'username' => username($first_name, $last_name),
            'email' => email($first_name, $last_name),
            'password' => bcrypt(password($first_name, $last_name, $dob))
        ]);
    }

    public function updatePassword($user, $fields)
    {
        $user->update([
            'password' => bcrypt(password($fields['first_name'], $fields['last_name'], $fields['dob']))
        ]);
    }
}