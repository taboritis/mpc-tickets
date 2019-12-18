<?php

namespace App\Http\Controllers\api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersApiController extends Controller
{
    public function index(Request $request)
    {
        return User::paginate(10);
    }
}
