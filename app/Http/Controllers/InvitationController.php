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

    public function update(Request $request, $id) {
        return Invitation::find($id)->update(['code' => $request->code, 'expires_at' => $request->expires_at]);
    }

    public function destroy($id) {
        return Invitation::destroy($id);
    }

    public function isCodeBusy(Request $request) {
        $result = $this->checkCode($request->code);
        return response($result['message'], $result['status']);
    }

    public function checkCode($code) {
        if (empty(Invitation::where('code', $code)->first())) {
            return ['message' => 'That code does not exist!', 'status' => 500];
        }
        if (Invitation::where('code', $code)->first()->user()->count() > 0) {
            return ['message' => 'That code is already taken!', 'status' => 500];
        } else {
            return ['message' => 'Free', 'status' => 200];
        }
    }

    public function generate(Request $request) {
        return Invitation::create([
            'code' => strtoupper(uniqid('BRP')),
            'created_by' => $request->user()->id,
            'expires_at'=> new Carbon('next month'),
        ]);
    }
}
