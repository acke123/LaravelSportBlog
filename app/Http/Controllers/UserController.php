<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
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
}
