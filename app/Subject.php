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

    public function getRouteKeyName()
    {
        return 'slug';
    }

}
