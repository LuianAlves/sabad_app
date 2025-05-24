<?php

namespace App\Http\Controllers\Business\User;

use App\Http\Controllers\Controller;

// Requests
use App\Http\Requests\Business\User\StoreUserRequest;
use App\Http\Requests\Business\User\UpdateUserRequest;

// Models
use App\Models\User;

// Dependences
use Spatie\Permission\Models\Permission;
use Carbon\Carbon;

class UserController extends Controller
{

    public function index()
    {
        $users = User::with('roles', 'permissions')->get();

        return view('app.business.user.user_index', compact('users'));
    }

    public function create()
    {
        $permissions = Permission::all()->groupBy(function ($permission) {
            return explode(' ', $permission->name)[1];
        });

        return view('app.business.user.user_create', compact('permissions'));
    }

    public function store(StoreUserRequest $request)
    {
        $request->validated();

        $isAdmin = (bool) $request->is_admin;

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'is_active' => (bool) $request->is_active,
            'created_at' => Carbon::now()
        ]);

        if ($isAdmin) {
            $user->assignRole('admin');
        } else {
            $user->assignRole('user');

            if ($request->has('permissions')) {
                $permissions = Permission::whereIn('name', $request->permissions)->get();
                $user->syncPermissions($permissions);
            }
        }

        return redirect()->route('user.index');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('app.business.user.user_show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('app.business.user.user_edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.index');
    }
}
