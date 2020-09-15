<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use App\Http\Resources\User as UserResource;
use Auth;
class UserController extends Controller
{
    
    public function index() {
        return UserResource::collection(User::all());
    }

    public function block($id) {
        if (Auth::id() == $id) abort(400, 'Can\'t block/unblock yourself');
        $user = User::find($id);
        $user->blocked = !$user->blocked;
        return $user->update();
    }

    public function isUsernameBusy(Request $request) {
        if (User::where('username', $request->username)->count()) {
            return response('That username is already taken!', 500);
        } else {
            return response('Free', 200);
        }
    }

    public function user(Request $request) {
        return new UserResource($request->user());
    }

}
