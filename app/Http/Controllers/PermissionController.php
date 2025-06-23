<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $permissions = Permission::all();

        return view('role-permission.permission.index-permission', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('role-permission.permission.create-permission');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:permissions,name',
            ],
        ]);
        Permission::create([
            'name' => $request->name,
        ]);

        return redirect('permissions')->with('success', 'Permission Created Successfully');
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
    public function edit(Permission $permission)
    {

        return view('role-permission.permission.edit-permission', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:permissions,name,'.$permission->id,
            ],
        ]);
        $permission->update([
            'name' => $request->name,
        ]);

        return redirect('permissions')->with('success', 'Permission Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($permission)
    {
        $permission = Permission::find($permission);
        $permission->delete();

        return redirect('permissions')->with('error', 'Permission Deleted Successfully');
    }
}
