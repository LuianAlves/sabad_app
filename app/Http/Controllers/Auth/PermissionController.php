<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::with('roles')->get();

        $knownActions = ['view', 'create', 'edit', 'delete', 'show', 'separate', 'start', 'finish'];

        $groupedPermissions = $permissions->groupBy(function ($permission) use ($knownActions) {
            $parts = explode(' ', $permission->name);
            $first = strtolower($parts[0] ?? '');

            if (in_array($first, $knownActions)) {
                // tira o verbo e mantém o resto como “entidade”
                return implode(' ', array_slice($parts, 1));
            }

            return $permission->name;
        });

        return view('app.auth.permissions.permission_index', [
            'permissions'        => $permissions,
            'groupedPermissions' => $groupedPermissions,
        ]);
    }

    public function create()
    {
        return view('app.auth.permissions.permission_create');
    }

    public function store(Request $request)
    {
        Permission::create([
            'name'       => $request->name,
            'guard_name' => 'web',
        ]);

        return redirect()->back();
    }

    public function edit(Permission $permission)
    {
        return view('app.auth.permissions.permission_edit', compact('permission'));
    }

    public function update(Request $request, Permission $permission)
    {
        $permission->update(['name' => $request->name]);

        return redirect()->route('permissions.index');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();

        return redirect()->route('permissions.index');
    }
}
