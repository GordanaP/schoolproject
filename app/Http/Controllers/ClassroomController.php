<?php

namespace App\Http\Controllers;

use App\Classroom;
use App\Http\Requests\ClassroomRequest;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    public function __construct()
    {
        // Authorize
        $this->authorizeResource(Classroom::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classrooms = Classroom::orderBy('label', 'asc')->get();

        return view('classrooms.index', compact('classrooms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('classrooms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClassroomRequest $request)
    {
        Classroom::create($request->all());

        return back()
            ->with('flash', 'A new classroom has been created.');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function edit(Classroom $classroom)
    {
        return view('classrooms.edit', compact('classroom'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function update(ClassroomRequest $request, Classroom $classroom)
    {
        $classroom->update($request->all());

        return redirect()->route('classrooms.edit', compact('classroom'))
            ->with('flash', 'The classroom has been updated.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classroom $classroom)
    {
        $classroom->delete();

        return back()
            ->with('flash', 'The classroom has been deleted.');

    }

    protected function resourceAbilityMap()
    {
        return [
            'index' => 'access',
            'create' => 'access',
            'store' => 'access',
            'edit' => 'access',
            'update' => 'access',
            'destroy' => 'access',
        ];
    }
}
