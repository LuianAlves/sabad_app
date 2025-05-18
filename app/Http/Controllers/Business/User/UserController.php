<?php

namespace App\Http\Controllers\Business\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Business\User\StoreUserRequest;
use App\Http\Requests\Business\User\UpdateUserRequest;

use App\Models\User;  

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
        return view('app.business.user.user_create');
    }
    
    public function store(StoreUserRequest $request)
    {
        $request->validated();

        if((bool) $request->is_admin) {
            $permission = 'admin';
        } else {
            $permission = 'user';
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'is_active' => (bool) $request->is_active,
            'created_at' => Carbon::now()
        ]);

        $user->assignRole($permission);

        return redirect()->route('user.index');
    }


    public function show($id)
    {
        return view('app.business.user.user_show');
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
