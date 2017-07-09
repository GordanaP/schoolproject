<?php

namespace App\Http\Controllers;

use App\User;
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
        $this->middleware('auth')->except('welcome');
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
     * Show the application landing page.
     *
     * @return \Illuminate\Http\Response
     */
    public function settings(User $user)
    {
        return view('pages.settings', compact('user'));
    }


}
