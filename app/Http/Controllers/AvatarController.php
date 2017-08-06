<?php

namespace App\Http\Controllers;

use App\Http\Requests\AvatarRequest;
use App\User;
use Auth;
use Codecourse\Notify\Facades\Notify;
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
    public function store(AvatarRequest $request, User $user)
    {
        if ($file = $request->file('image'))
        {
            $file->storeAs('avatars', filename($user->id, 'profile'));
        }

        if (Auth::user()->isSuperAdmin())
        {
            return back()
                ->with('flash', 'The avatar has been uploaded.');
        }
        else
        {
            Notify::flash('The avatar has been uploaded.', 'success');
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
        $file = Storage::disk('avatars')->get(filename($user->id, 'profile'));

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
        if (Storage::disk('avatars')->has(filename($user->id, 'profile')))
        {
            Storage::disk('avatars')->delete(filename($user->id, 'profile'));
        }

        if (Auth::user()->isSuperAdmin())
        {
            return back()
                ->with('flash', 'The avatar has been deleted.');
        }
        else
        {
            Notify::flash('The avatar has been deleted.', 'success');
            return back();
        }
    }

    protected function resourceAbilityMap()
    {
         return [
            'store' => 'access',
            'destroy' => 'updateAccount',
        ];
    }
}