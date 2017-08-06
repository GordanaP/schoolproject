<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;
use Storage;

class AvatarController extends Controller
{
    public function __construct()
    {
        //Authenticate
        $this->middleware('auth')->only('show');

        //Authorize
        $this->authorizeResource(User::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        if ($file = $request->file('image'))
        {
            $file->storeAs('profiles', filename($user->id, 'profile'));
        }

        if (Auth::user()->isSuperAdmin())
        {
            return back()
                ->with('flash', 'The profile image has been uploaded.');
        }
        else
        {
            Notify::flash('The profile image has been uploaded.', 'success');
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $file = Storage::disk('profiles')->get(filename($user->id, 'profile'));

        return $file;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (Storage::disk('profiles')->has(filename($user->id, 'profile')))
        {
            Storage::disk('profiles')->delete(filename($user->id, 'profile'));
        }

        if (Auth::user()->isSuperAdmin())
        {
            return back()
                ->with('flash', 'The profile image has been deleted.');
        }
        else
        {
            Notify::flash('The profile image has been deleted.', 'success');
            return back();
        }
    }

    protected function resourceAbilityMap()
    {
         return [
            'store' => 'updateAccount',
            'destroy' => 'updateAccount',
        ];
    }
}