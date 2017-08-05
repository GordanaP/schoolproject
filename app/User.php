<?php

namespace App;

use App\Role;
use App\Traits\UserAccount;
use App\Traits\UserAttributes;
use App\Traits\UserRoles;
use App\User;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, UserRoles, UserAccount, UserAttributes;

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

    public function owns($related)
    {
        return $this->id == $related->user_id;
    }

    public function me($user)
    {
        return $this->id === $user->id;
    }

}