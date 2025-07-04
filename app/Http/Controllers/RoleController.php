<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\Permission\Middleware\PermissionMiddleware;

class RoleController extends Controller
{
     public static function middleware()
    {
        return [
            new Middleware(
                PermissionMiddleware::using('view role'),
                 ['index', 'show']
            ),
            new Middleware(
                PermissionMiddleware::using('delete role'),
                ['destroy']
            ),
            new Middleware(
                PermissionMiddleware::using('update role'),
                ['update', 'edit']
            ),
            new Middleware(
                PermissionMiddleware::using('create role'),
                ['create', 'store','addPermissionToRole','givePermissionToRole']
            ),
        ];
    
    }
    public function index()
    {
        $roles = Role::get();

        return view('role-permission.role.index-role', ['roles' => $roles]);
    }

    // create and store method role controller
    public function create()
    {
        return view('role-permission.role.create-role');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:roles,name',
            ],
        ]);

        Role::create([
            'name' => $request->name,
        ]);

        return redirect('roles')->with('success', 'Role Created Successfully');
    }

    // edit and update method role controller
    public function edit(Role $role)
    {
        return view('role-permission.role.edit-role', [
            'role' => $role,
        ]);
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:roles,name,'.$role->id,
            ],
        ]);

        $role->update([
            'name' => $request->name,
        ]);

        return redirect('roles')->with('success', 'Role Updated Successfully');
    }

    // 6 destroy method role controller
    public function destroy($roleId)
    {
        $role = Role::find($roleId);
        $role->delete();

        return redirect('roles')->with('error', 'Role Deleted Successfully');
    }

    public function addPermissionToRole($roleId)
    {
        $permissions = Permission::get();
        $role = Role::findOrFail($roleId);
        $rolePermissions = DB::table('role_has_permissions')
            ->where('role_has_permissions.role_id', $role->id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        return view('role-permission.role.add-permissions', [
            'role' => $role,
            'permissions' => $permissions,
            'rolePermissions' => $rolePermissions,
        ]);
    }

    public function givePermissionToRole(Request $request, $roleId)
    {
        $request->validate([
            'permission' => 'required',
        ]);

        $role = Role::findOrFail($roleId);
        $role->syncPermissions($request->permission);

        return redirect()->back()->with('status', 'Permissions added to role');
    }
}
