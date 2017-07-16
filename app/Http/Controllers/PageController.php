<?php

namespace App\Http\Controllers;

use App\User;
use Gate;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //Authenticate
        $this->middleware('auth')->only('home');

        //Authorize
        $this->authorizeResource(User::class);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        return view('pages.home');
    }

    /**
     * Show the application landing page.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view('welcome');
    }

    /**
     * Show the user's settings page.
     *
     * @return \Illuminate\Http\Response
     */
    public function settings(User $user)
    {
        return view('pages.settings', compact('user'));
    }


    /**
     * Show the admin dashboard page.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        return view('pages.dashboard');
    }


    protected function resourceAbilityMap()
    {
         return [
            'settings'  => 'updatePassword',
            'dashboard'  => 'access',
        ];
    }
}