<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountRequest;
use App\Http\Requests\PasswordRequest;
use App\Role;
use App\Student;
use App\Teacher;
use App\User;
use Codecourse\Notify\Facades\Notify;

class AccountController extends Controller
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
        $users = User::with('roles')->get();

        return view('accounts.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('accounts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\AccountRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AccountRequest $request)
    {
        // Create user
        $a = random_int(1000, 9999);
        $b = random_int(10, 99);

        $name = name($request->first_name, $request->last_name, $a);
        $email = email($request->first_name, $request->last_name, $b);

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($request->password)
        ]);

        // Assign role
        $user->assignRole($request->role_id);

        // Create profile
        $user->createProfile($request->role_id, $request->all());

        return back()
            ->with('flash', 'A new account has been created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('accounts.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\AccountRequest  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(AccountRequest $request, User $user)
    {
        if (! $request->password == '')
        {
            $user->update([
                'password' => bcrypt($request->password)
            ]);
        }

        $user->roles()->sync($request->role_id);

        return redirect()->route('accounts.edit', $user)
            ->with('flash', 'The account has been updated.');
    }

    /**
     * Update the specified resource in storage.
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
        $user->delete();

        return back()->with('flash', 'The account has been deleted.');
    }

    protected function resourceAbilityMap()
    {
         return [
            'index' => 'access',
            'create' => 'access',
            'store' => 'access',
            'edit' => 'access',
            'update' => 'access',
            'delete' => 'access',
            'updatePassword'  => 'updatePassword',
        ];
    }
}