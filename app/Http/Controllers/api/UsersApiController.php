<?php

namespace App\Http\Controllers\api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;

class UsersApiController extends Controller
{
    public function index(Request $request)
    {
        $users = User::with('tickets', 'notes')->paginate(10);

        return UserResource::collection($users);
    }
}
