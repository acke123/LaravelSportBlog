<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function getAllUsers()
    {
        Gate::authorize('updateUser', User::class);
        $users = Cache::remember('users', 600,
            fn () => User::all());
        return view('users.usersView', ['users' => $users]);
    }

    public function getUser(User $user)
    {
        Gate::authorize('updateUser', User::class);
        return view('users.editUser', ['user' => $user]);
    }

    public function editUser(Request $request, User $user)
    {
        Gate::authorize('updateUser', User::class);
        $validate = $request->validate([
            'name' => 'required',
            'role' => 'required|in:admin,editor,normal'
        ]);
        $user->update($validate);
        return redirect()->route('usersView');
    }

    public function deleteUser(User $user)
    {
        Gate::authorize('updateUser', User::class);
        $user->delete();
        return redirect()->route('usersView');
    }
}
