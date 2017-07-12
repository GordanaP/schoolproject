<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountRequest;
use App\Role;
use App\Student;
use App\Teacher;
use App\User;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AccountRequest $request)
    {
        $a = random_int(1000, 9999);
        $b = random_int(10, 99);

        $name = name($request->first_name, $request->last_name, $a);
        $email = email($request->first_name, $request->last_name, $b);

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($request->password)
        ]);

        $user->roles()->attach($request->role_id);

        $roles = Role::whereIn('id', $request->role_id)->pluck('name')->toArray();

        if(in_array('teacher', $roles))
        {
            $user->teacher()->create($request->all());
        }

        if(in_array('student', $roles))
        {
            $user->student()->create($request->all());
        }

        return back();
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
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if ($request->password == '')
        {
            $user->update($request->except('password'));
        }
        else
        {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);
        }

        return redirect()->route('accounts.edit', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request, User $user)
    {
        if (! $request->password == '')
        {
            $user->update([
                'password' => bcrypt($request->password)
            ]);

            return back();
        }
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

        return back();
    }
}