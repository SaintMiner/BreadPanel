<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Invitation;

use App\Http\Resources\Invitation as InvitationResource;

class InvitationController extends Controller
{
    public function index() {
        return InvitationResource::collection(Invitation::all());
    }

    public function isCodeBusy(Request $request) {
        if (empty(Invitation::where('code', $request->code)->first())) {
            return response('That code does not exist!', 500);
        }
        if (Invitation::where('code', $request->code)->first()->user()->count() > 0) {
            return response('That code is already taken!', 500);
        } else {
            return response('Free', 200);
        }
    }

    public function generate(Request $request) {
        return Invitation::create([
            'code' => uniqid('BRP'),
            'create_by' => $request->user()->id, //change to created_by
            'expires_at'=> new Carbon('next month'),
        ]);
    }
}
