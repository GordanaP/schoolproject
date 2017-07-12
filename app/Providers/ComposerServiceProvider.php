<?php

namespace App\Providers;

use App\Classroom;
use App\Role;
use App\Subject;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $roles = Role::orderBy('name', 'asc')->get();
        $classes = Classroom::all();
        $subjects = Subject::orderBy('name')->get();

        View::share('roles', $roles);
        View::share('classes', $classes);
        View::share('subjects', $subjects);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
