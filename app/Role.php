<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name'];

    protected static function boot()
    {
        parent::boot();

        static::observe(\App\Observers\RoleObserver::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function getRoleNameAttribute()
    {
        return ucfirst($this->name);
    }

    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }
}
