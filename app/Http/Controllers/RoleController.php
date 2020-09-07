<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index() {
        return Role::all();
    },

    public function store(Request $request) {
        $this->validate($request, [
            'name' => ['required', 'string','min: 4'],
            'description' => ['nullable', 'string','min: 4'],
        ]);
    }
}
