<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use App\Http\Resources\Role as RoleResource;

use App\Http\Requests\StoreRole;

class RoleController extends Controller
{
    public function index() {
        return RoleResource::collection(Role::all());
    }

    public function store(StoreRole $request) {
        $role = Role::create($request->all());
        $role->syncPermissions($request->permissions);
        return $role;
    }

    public function update(StoreRole $request, $id) {
        $role = Role::find($id);
        $role->update($request->all());
        $role->syncPermissions($request->permissions);
        return $role;
    }

    public function destroy($id) {
        return Role::destroy($id);
    }
}
