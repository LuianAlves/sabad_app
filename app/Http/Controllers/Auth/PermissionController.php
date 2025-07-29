<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index() {
        $permissions = Permission::all();
        return view('app.auth.permissions.permission_index', compact('permissions'));
    }

    public function create() {
        return view('app.auth.permissions.permission_create');
    }

    public function store(Request $request) {
        Permission::create(['name' => $request->name,  'guard_name' => 'web']);
        return redirect()->route('permissions.index');
    }

    public function edit(Permission $permission) {
        return view('app.auth.permissions.permission_edit', compact('permission'));
    }

    public function update(Request $request, Permission $permission) {
        $permission->update(['name' => $request->name]);
        return redirect()->route('permissions.index');
    }

    public function destroy(Permission $permission) {
        $permission->delete();
        return redirect()->route('permissions.index');
    }
}
