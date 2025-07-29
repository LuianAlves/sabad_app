<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index() {
        $roles = Role::with(['permissions'])->where('guard_name', 'web')->get();

        $knownActions = ['view', 'create', 'edit', 'delete', 'show'];

        $permissions = Permission::all()->groupBy(function ($permission) use ($knownActions) {
            $parts = explode(' ', $permission->name);
            $first = strtolower($parts[0]);

            if (in_array($first, $knownActions)) {
                // Remove o verbo e junta o resto
                return implode(' ', array_slice($parts, 1));
            }

            // Se não for verbo conhecido, mantém tudo
            return $permission->name;
        });

        return view('app.auth.roles.role_index', [
            'roles' => $roles,
            'groupedPermissions' => $permissions
        ]);
    }

    public function create() {
        $permissions = Permission::all();
        return view('app.auth.roles.role_create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => 'array',
            'permissions.*' => 'integer|exists:permissions,id',
        ]);

        $role = Role::create([
            'name' => $request->input('name'),
            'guard_name' => 'web',
        ]);

        $permissions = Permission::whereIn('id', $request->input('permissions', []))
            ->where('guard_name', 'web')
            ->pluck('name')
            ->toArray();

        $role->syncPermissions($permissions);


        return redirect()->route('roles.index')->with('success', 'Perfil criado com sucesso!');
    }


    public function edit(Role $role) {
        $permissions = Permission::all();
        return view('app.auth.roles.role_edit', compact('role', 'permissions'));
    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $request->validate([
            'permissions' => 'array',
            'permissions.*' => 'integer|exists:permissions,id',
        ]);

        $permissions = $request->input('permissions', []);

        // Converte IDs para nomes
        $permissionNames = \Spatie\Permission\Models\Permission::whereIn('id', $permissions)->pluck('name')->toArray();

        $role->syncPermissions($permissionNames);

        return redirect()->back()->with('success', 'Permissões atualizadas com sucesso para o perfil: ' . $role->name);
    }


    public function destroy(Role $role) {
        $role->delete();
        return redirect()->route('roles.index');
    }
}
