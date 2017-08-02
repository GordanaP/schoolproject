<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = ['first_name', 'last_name', 'cwid', 'dob', 'about'];

    protected $dates = ['dob'];

    protected static function boot()
    {
        parent::boot();

        static::observe(\App\Observers\TeacherObserver::class);
    }

    public function getFullNameAttribute()
    {
        return ucfirst($this->first_name) . ' ' .ucfirst($this->last_name);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function classrooms()
    // {
    //     return $this->belongsToMany(Classroom::class)->withPivot('subject_id');
    // }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class)->withPivot('classroom_id');
    }
}
