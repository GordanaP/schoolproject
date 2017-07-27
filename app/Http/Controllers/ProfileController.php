<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Student;
use App\Teacher;
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
    public function teachersIndex()
    {
        $teachers = Teacher::with('user')->get();

        return view('profiles.teachers_index', compact('teachers'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function studentsIndex()
    {
        $students = Student::with('user')->get();

        return view('profiles.students_index', compact('students'));
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
        $a = random_int(1000, 9999);
        $b = random_int(10, 99);

        $name = name($request->first_name, $request->last_name, $a);
        $email = email($request->first_name, $request->last_name, $b);
        $slug = slug($request->first_name, $request->last_name, $b);

        if($user->isStudent())
        {
            // Update account
            if($request->first_name != $user->student->first_name || $request->last_name != $user->student->last_name)
            {
                $user->update([
                    'name' => $name,
                    'email' => $email,
                ]);
            }

            // Update profile
            $user->student()->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'slug' => $slug,
                'about' => $request->about
            ]);
        }

        if ($user->isTeacher())
        {
            if($request->first_name != $user->teacher->first_name || $request->last_name != $user->teacher->last_name)
            {
                // Update account
                $user->update([
                    'name' => $name,
                    'email' => $email,
                ]);
            }

            // Update profile
            $user->teacher()->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'slug' => $slug,
                'about' => $request->about
            ]);
        }

        // Update role
        $user->roles()->sync($request->role_id);

        // Update image
        if ($file = $request->file('image'))
        {
            $file->storeAs('profiles', filename($user->id, 'profile'));
        }

        Notify::flash('The profile has been updated.', 'success');
        return redirect()->route('profiles.edit', $user);
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
            'teachersIndex' => 'access',
            'studentsIndex' => 'access',
            'edit' => 'access',
            'update' => 'updateAccount',
            'showFile' => 'updateAccount',
            'destroy'  => 'updateAccount',
        ];
    }
}
