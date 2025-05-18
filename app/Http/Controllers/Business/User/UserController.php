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

        User::create($request->all());

        return redirect()->route('user.index');
    }


    public function show(string $id)
    {
        return view('app.business.user.user_show');
    }

    public function edit(string $id)
    {
        return view('app.business.user.user_edit');
    }

    public function update(UpdateUserRequest $request, $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
