<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['name'];

    protected static function boot()
    {
        parent::boot();

        static::observe(\App\Observers\SubjectObserver::class);
    }

    // public function getRouteKeyName()
    // {
    //     return 'slug';
    // }

    public function getNameAttribute($value)
    {
        return ucwords($value);
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class)->withPivot('classroom_id');
    }

    public function lectures()
    {
        return $this->hasMany(Lecture::class);
    }

}
