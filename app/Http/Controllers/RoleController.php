<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use App\Http\Resources\Role as RoleResource;

class RoleController extends Controller
{
    public function index() {
        return RoleResource::collection(Role::all());
    }

    public function store(Request $request) {
        // $this->validate($request, [
        //     'name' => ['required', 'string','min: 4'],
        //     'description' => ['nullable', 'string'],
        //     'color' => ['nullable', 'string', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
        // ]);
        $role = Role::create($request->all());
        $role->syncPermissions($request->permissions);
        return $role;
    }

    public function update(Request $request, $id) {
        $role = Role::find($id);
        $role->update($request->all());
        $role->syncPermissions($request->permissions);
        return $role;
    }

    public function destroy($id) {
        return Role::destroy($id);
    }
}
