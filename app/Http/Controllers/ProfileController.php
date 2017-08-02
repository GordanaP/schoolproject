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
        // Student
        if($user->isStudent())
        {
            $user->student()->update([
                'classroom_id' => $request->classroom_id,
                'about' => $request->about,
            ]);
        }

        // Teacher
        if ($user->isTeacher())
        {
            $user->teacher()->update([
                'about' => $request->about,
            ]);

            //Update subjects & classrooms
            $teacher = Teacher::where('user_id', $user->id)->first() ;
            $classrooms = Classroom::whereIn('id', $request->classroom_id)->get();

            if (! $teacher->classrooms()->where('subject_id', $request->subject_id)->count() > 0)
            {
                foreach ($request->classroom_id as $classroom_id)
                {
                    $teacher->classrooms()->attach($classroom_id, [
                        'subject_id' => $request->subject_id,
                    ]);
                }
            }
            else
            {
                foreach ($request->classroom_id as $classroom_id)
                {
                    $teacher->classrooms()->updateExistingPivot($classroom_id, ['subject_id' => [$request->subject_id]]);
                }
            }
        }

        // Update image
        if ($file = $request->file('image'))
        {
            $file->storeAs('profiles', filename($user->id, 'profile'));
        }

        return redirect()->route('profiles.edit', $user)
            ->with('flash', 'The profile has been updated.');
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
            'update' => 'access',
            'showFile' => 'updateAccount',
            'destroy'  => 'updateAccount',
        ];
    }
}
