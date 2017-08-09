<?php

namespace App\Providers;

use App\Role;
use Illuminate\Support\ServiceProvider;
use Validator;

class ValidatorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('alpha_spaces', function($attribute, $value)
        {
            return preg_match('/^[a-zA-Z ]+$/', $value);
        });

        Validator::extend('exclude_one', function($attribute, $value)
        {
            $array = [1, 2];

            return array_intersect($array, $value) != $array;
        });

        Validator::extend('exclude_two', function($attribute, $value)
        {
            $array = [3, 4];

            return array_intersect($array, $value) != $array;
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

    }
}