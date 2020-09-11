<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index() {
        return Role::all();
    }

    public function store(Request $request) {
        return $request;
        $this->validate($request, [
            'name' => ['required', 'string','min: 4'],
            'description' => ['nullable', 'string'],
            'color' => ['nullable', 'string', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
        ]);
        return Role::create($request->all());
    }

    public function update(Request $request, $id) {
        return Role::find($id)->update($request->all());
    }

    public function destroy($id) {
        return Role::destroy($id);
    }
}
