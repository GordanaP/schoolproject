<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\User;
use Codecourse\Notify\Facades\Notify;
use Storage;

class ProfileController extends Controller
{
    public function __construct()
    {
        //Authenticate
        $this->middleware('auth')->only('show');

        //Authorize
        $this->authorizeResource(User::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('profiles.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('profiles.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileRequest $request, User $user)
    {
        // Update profile
        if ($user->isTeacher())
        {
            $user->teacher()->update([
                'about' => $request->about
            ]);
        }
        elseif($user->isStudent())
        {
            $user->student()->update([
                'about' => $request->about
            ]);
        }

        // Update image
        if ($file = $request->file('image'))
        {
            $file->storeAs('profiles', filename($user->id, 'profile'));
        }

        Notify::flash('The profile has been updated.', 'success');
        return back();
    }


    /**
     * Display the image of the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function showFile(User $user)
    {
        $file = Storage::disk('profiles')->get(filename($user->id, 'profile'));

        return $file;
    }

    /**
     * Remove the image of the specified resource from storage.
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

        Notify::flash('The profile image has been deleted.', 'success');
        return back();
    }

    protected function resourceAbilityMap()
    {
         return [
            'index' => 'access',
            'edit' => 'access',
            'update' => 'updateAccount',
            'showFile' => 'updateAccount',
            'destroy'  => 'updateAccount',
        ];
    }
}
