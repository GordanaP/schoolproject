<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountRequest;
use App\Http\Requests\PasswordRequest;
use App\Role;
use App\User;
use Codecourse\Notify\Facades\Notify;
use Illuminate\Http\Request;
use Storage;

class AccountController extends Controller
{
    public function __construct()
    {
        // Authorize
        $this->authorizeResource(User::class);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();

        return view('accounts.create', compact('roles', 'age'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\AccountRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AccountRequest $request)
    {
        // Create account
        $user = User::createAccount($request);

        // Assign role
        $user->assignRole($request->role_id);

        // Create profile
        $user->createProfile($request->role_id, $request->all());

        // Redirect
        return redirect()->route('profiles.edit', $user)
            ->with('flash', 'A new account has been created.');
    }

    /**
     * Reset password by an admin.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function resetPassword(Request $request, User $user)
    {
        $user->update([
            'password' => password($request->first_name, $request->last_name, $request->dob)
        ]);

        return response([
            'message' => 'The password has been reset',
        ]);
    }

    /**
     * Change password by a user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(PasswordRequest $request, User $user)
    {
        if (! $request->password == '')
        {
            $user->update([
                'password' => bcrypt($request->password)
            ]);
        }

        Notify::flash('The password has been changed.', 'success');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // Remove avatar
        if (Storage::disk('avatars')->has(filename($user->id, 'profile')))
        {
            Storage::disk('avatars')->delete(filename($user->id, 'profile'));
        }

        // Remove account
        $user->delete();

        // Redirect
        return back()
            ->with('flash', 'The account has been deleted.');
    }

    protected function resourceAbilityMap()
    {
         return [
            'create' => 'access',
            'store' => 'access',
            'resetPassword'  => 'access',
            'updatePassword'  => 'updateAccount',
            'destroy' => 'access',
        ];
    }
}