<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['title', 'subject_id', 'classroom_id', 'start', 'end'];

    protected $dates = ['start', 'end'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
