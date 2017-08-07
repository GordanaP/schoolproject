<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        // Authorize
        $this->authorizeResource(Role::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();

        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        Role::create($request->all());

        return back()
            ->with('flash', 'A new role has been created.');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {

        return view('roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, Role $role)
    {
        $role->update($request->all());

        return redirect()->route('roles.edit', compact('role'))
            ->with('flash', 'The role has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return back()
            ->with('flash', 'The role has been deleted.');
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