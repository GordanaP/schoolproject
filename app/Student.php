<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'cwid', 'first_name', 'last_name', 'gender', 'parent', 'dob', 'birthplace', 'about', 'classroom_id'
    ];

    protected $dates = ['dob'];

    protected static function boot()
    {
        parent::boot();

        static::observe(\App\Observers\StudentObserver::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function getNameAttribute()
    {
       return ucfirst($this->first_name);
    }

    public function getFullNameAttribute()
    {
        return ucfirst($this->first_name) . ' ' .ucfirst($this->last_name);
    }
}
