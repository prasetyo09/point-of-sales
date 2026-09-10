<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $btnTitle = "Add New Role";
        $btnUrl = route('role.create');
        $subtitle = "information regarding the role";
        $title = "Role";
        $roles = Role::orderBy('id', 'ASC')->get();
        return view('role.index', compact('roles', 'title', 'btnTitle', 'btnUrl', 'subtitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Add Role";
        $subtitle = "Add the role in accordance with the rules.";
        return view('role.create', compact('title', 'subtitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Role::create([
            'name' => $request->name
        ]);

        return redirect()->to('role')->with('success', 'Role successfully saved!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $roles = Role::find($id);
        $title = "Edit Role";
        $subtitle = "Edit the role in accordance with the rules.";
        return view('role.edit', compact('roles', 'title', 'subtitle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $role = Role::findOrFail($id);
        $role->update([
            'name' => $request->name
        ]);

        return redirect()->to('role')->with('success', 'Role successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->to('role')->with('success', 'Role successfully deleted!');
    }
}
