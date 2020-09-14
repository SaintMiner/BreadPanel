<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use App\Http\Resources\User as UserResource;

class UserController extends Controller
{
    
    public function index() {
        return UserResource::collection(User::all());
    }

    public function user(Request $request) {
        return new UserResource($request->user());
    }

}
