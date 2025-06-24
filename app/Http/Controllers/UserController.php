<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Spatie\Permission\Models\Role;

class UserController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware(
                PermissionMiddleware::using('view user'),
                ['view']
            ),
            new Middleware(
                PermissionMiddleware::using('delete user'),
                ['destroy']
            ),
            new Middleware(
                PermissionMiddleware::using('update user'),
                ['update', 'edit']
            ),
            new Middleware(
                PermissionMiddleware::using('create user'),
                ['create', 'store']
            ),
        ];

    }

    // 7-index method
    public function index(Request $request)
    {
        // 8get all users
        // 9$users = User::get();
        $search = $request->input('search');
        $users = User::when($search, function ($query, $search) {
            return $query->where('email', 'like', "%{$search}%");
        })->get();

        return view('role-permission.user.index', ['users' => $users]);
    }

    // 10create and store method
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();

        return view('role-permission.user.create', ['roles' => $roles]);
    }

    public function store(Request $request)
    {
        // 11--validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|max:25',
            'roles' => 'required',
        ]);
        // 13create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        // 14--sync roles
        $user->syncRoles($request->roles);

        return redirect('/users')->with('status', 'User created successfully with roles');
    }

    // 15-edit and update method
    public function edit(User $user)
    {
        // 17--get all roles
        // 18-get user roles
        // 19-return view with user, roles and userRoles

        $roles = Role::pluck('name', 'name')->all();
        $userRoles = $user->roles->pluck('name', 'name')->all();

        return view('role-permission.user.edit', [
            'user' => $user,
            'roles' => $roles,
            'userRoles' => $userRoles,
        ]);
    }

    public function update(Request $request, User $user)
    {
        // 20-validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|max:20',
            'roles' => 'required',
        ]);
        // 21-update user
        // 22-sync roles
        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if (! empty($request->password)) {
            $data += [
                'password' => Hash::make($request->password),
            ];
        }

        $user->update($data);
        $user->syncRoles($request->roles);

        return redirect('/users')->with('status', 'User Updated Successfully with roles');
    }

    // 23-delete method
    public function destroy($userId)
    {
        // 24-find user by id and delete
        $user = User::findOrFail($userId);
        $user->delete();

        return redirect('/users')->with('status', 'User Delete Successfully');
    }
}
