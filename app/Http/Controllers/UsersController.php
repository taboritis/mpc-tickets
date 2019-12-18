<?php

namespace App\Http\Controllers;

use App\User;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::with('notes', 'tickets')
            ->paginate(10);

        return view('users.index', compact('users'));
    }
}
