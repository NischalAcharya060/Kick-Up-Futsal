<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $roles = Role::all();
        return view('admin.users.index', compact('users', 'roles'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {

    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
//    public function updateRole(Request $request, User $user)
//    {
//        try {
//            $roles = Role::all();
//            // Validation
//            $request->validate([
//                'role' => 'required|in:' . $roles->pluck('name')->implode(','),
//            ]);
//            // Sync the user's roles
//            $user->syncRoles([$request->input('role')]);
//            return redirect()->route('admin.users.index')->with('success', 'User role updated successfully.');
//        } catch (\Exception $e) {
//            // Handle the exception here
//            return redirect()->route('admin.users.index')->with('error', 'An error occurred while updating user role.');
//        }
//    }


}
