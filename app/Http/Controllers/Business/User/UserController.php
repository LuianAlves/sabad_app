<?php

namespace App\Http\Controllers\Business\User;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\User;  

use Carbon\Carbon;

class UserController extends Controller
{

    public function index()
    {
        $users = User::get();        

        return view('app.business.user.user_index', compact('users'));
    }

    public function create()
    {
        return view('app.business.user.user_create');
    }

    
    public function store(Request $request)
    {
        //
    }


    public function show(string $id)
    {
        return view('app.business.user.user_show');
    }

    public function edit(string $id)
    {
        return view('app.business.user.user_edit');
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
