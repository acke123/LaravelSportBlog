<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{
    public function getAllUsers()
    {
        $users = Cache::remember('users', 600,
            fn () => User::all());
        return view('users.usersView', ['users' => $users]);
    }

    public function getUser(User $user)
    {
        return view('users.editUser', ['user' => $user]);
    }

    public function editUser(Request $request, User $user)
    {
        $validate = $request->validate([
            'name' => 'required',
            'role' => 'required|in:admin,editor,normal'
        ]);
        $user->update($validate);
        return redirect()->route('usersView');
    }

    public function deleteUser(User $user)
    {
        $user->delete();
        return redirect()->route('usersView');
    }
}
