<?php

namespace App\Services\Utilities;

class Gender
{
    protected static $genders = [
        'M' => 'Male',
        'F' => 'Female',
    ];

    public static function all()
    {
        return static::$genders;
    }
}