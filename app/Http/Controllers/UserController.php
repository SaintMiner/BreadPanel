<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\User as UserResource;

class UserController extends Controller
{
    
    public function user(Request $request) {
        return new UserResource($request->user());
    }

}
