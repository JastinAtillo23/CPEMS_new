<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->get();
        $roles = Role::all();
        return view('users.index', compact('users', 'roles'));
    }

    public function updateStatus(Request $request, User $user)
    {
        $user->update([
            'status' => $request->status,
            'role_id' => $request->role_id
        ]);

        return back()->with('success', 'User updated successfully!');
    }

    public function destroy(User $user)
    {
        if (auth()->check() && auth()->id() === $user->id) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return back()->with('success', 'User deleted successfully!');
    }

    public function roleAccounts()
    {
        $roles = Role::with('users')->orderBy('id')->get();

        return view('users.role_accounts', compact('roles'));
    }
}