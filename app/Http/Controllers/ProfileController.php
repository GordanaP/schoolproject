<?php

namespace App\Http\Controllers;

use App\Classroom;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\UserProfileRequest;
use App\Role;
use App\Student;
use App\Subject;
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
        if (request()->ajax())
        {
            return response([
                'user' => $user->isStudent() ? $user->student : $user->teacher,
                'role' => $user->isStudent() ? 'student' : 'teacher',
                'avatar' => Storage::disk('avatars')->has(filename($user->id, 'profile')) ? 'avatar' : 'noAvatar'
            ]);
        }
        else
        {
            return view('profiles.show', compact('user'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        $subjects = Subject::orderBy('name', 'asc')->get();
        $classrooms = Classroom::orderBy('label', 'asc')->get();

        if (request()->ajax())
        {
            if ($user->isStudent())
            {
                return $user->student;
            }
            else{
                return $user->teacher;
            }
        }
        else
        {
            return view('profiles.edit', compact('user', 'roles', 'subjects', 'classrooms'));
        }
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
        // Update account
        $user->updateAccount($user, $request);

        //Subjects & classrooms
        if ($user->isTeacher())
        {
            $teacher = $user->teacher;

            foreach ($request->classroom_id as $id)
            {
                $teacher->subjects()->attach($request->subject_id, [
                    'classroom_id' => $id,
                ]);
            }
        }

        // Update role
        $user->assignRole($request->role_id);

        // Update profile
        $user->updateProfile($user, $request);

        // Redirect()
        return redirect()->route('profiles.edit', $user)
            ->with('flash', 'The profile has been updated.');
    }


    public function updateProfile(UserProfileRequest $request, User $user)
    {
        // Update avatar
        if ($file = $request->file('image'))
        {
            $file->storeAs('avatars', filename($user->id, 'profile'));
        }

        // Update account
        $user->student()->update([
            'about' => $request->about
        ]);

        // Redirect
        Notify::flash('The profile has been updated.', 'success');
        return back();
    }

    protected function resourceAbilityMap()
    {
         return [
            'teachersIndex' => 'access',
            'studentsIndex' => 'access',
            'edit' => 'access',
            'update'  => 'access',
            'updateProfile'  => 'updateAccount',
        ];
    }
}
