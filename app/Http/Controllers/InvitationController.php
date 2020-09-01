<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Invitation;

class InvitationController extends Controller
{
    public function isCodeBusy(Request $request) {
        if (empty(Invitation::where('code', $request->code)->first())) {
            return response('That code does not exist!', 500);
        }
        if (Invitation::where('code', $request->code)->first()->user()->count() > 0) {
            return response('That code is already taken!', 500);
        } else {
            return response('Free)', 200);
        }
    }
}
