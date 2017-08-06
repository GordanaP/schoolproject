<?php

namespace App\Http\Controllers;

use App\Classroom;
use App\Http\Requests\ProfileRequest;
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
        $roles = Role::all();
        $subjects = Subject::orderBy('name', 'asc')->get();
        $classrooms = Classroom::orderBy('label', 'asc')->get();

        return view('profiles.edit', compact('user', 'roles', 'subjects', 'classrooms'));
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

        // Subjects & classrooms
        // if ($user->isTeacher())
        // {
        //     $teacher = Teacher::where('user_id', $user->id)->first() ;
        //     $classrooms = Classroom::whereIn('id', $request->classroom_id)->get();

        //     foreach ($request->classroom_id as $id)
        //     {
        //         $teacher->subjects()->attach($request->subject_id, [
        //             'classroom_id' => $id,
        //         ]);
        //     }
        // }

        // Update role
        $user->assignRole($request->role_id);

        // Update profile
        $user->updateProfile($user, $request);

        // Redirect()
        return redirect()->route('profiles.edit', $user)
            ->with('flash', 'The profile has been updated.');
    }

    protected function resourceAbilityMap()
    {
         return [
            'teachersIndex' => 'access',
            'studentsIndex' => 'access',
            'edit' => 'access',
            'update'  => 'access',
        ];
    }
}
