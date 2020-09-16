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

    public function show($id) {
        return new UserResource(User::find($id));
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

    public function crumbTop() {
        return UserResource::collection(User::orderByDesc('crumbs')->orderBy('updated_at', 'ASC')->get());
    }
    
    public function setInitialAvatar(Request $request) {
        $user = User::find(Auth::id());
        $user->initial_background = $request->color['hex'];
        $user->initials = $request->initials;
        $user->initial_avatar = true;
        $user->with_initials = $request->withInitials;
        return $user->update();
    }

}
