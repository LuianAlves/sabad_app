<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index() {
        $roles = Role::all();
        return view('app.auth.roles.role_index', compact('roles'));
    }

    public function create() {
        $permissions = Permission::all();
        return view('app.auth.roles.role_create', compact('permissions'));
    }

    public function store(Request $request) {
        $role = Role::create(['name' => $request->name]);
        $role->syncPermissions($request->permissions);
        return redirect()->route('roles.index');
    }

    public function edit(Role $role) {
        $permissions = Permission::all();
        return view('app.auth.roles.role_edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role) {
        $role->update(['name' => $request->name]);
        $role->syncPermissions($request->permissions);
        return redirect()->route('roles.index');
    }

    public function destroy(Role $role) {
        $role->delete();
        return redirect()->route('roles.index');
    }
}
