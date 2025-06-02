<?php

namespace App\Http\Controllers\Collaborator;

use App\Http\Controllers\Controller;
use App\Models\Collaborator\Collaborator;
use App\Http\Requests\StoreCollaboratorRequest;
use App\Http\Requests\UpdateCollaboratorRequest;
use App\Models\User;

class CollaboratorController extends Controller
{
    
    public function index()
    {
        $users = User::get();

        return view('app.collaborator.collaborator_index', compact('users'));
    }

    
    public function create()
    {
        //
    }

    
    public function store(StoreCollaboratorRequest $request)
    {
        //
    }

    
    public function show(Collaborator $collaborator)
    {
        //
    }

    
    public function edit(Collaborator $collaborator)
    {
        //
    }

    
    public function update(UpdateCollaboratorRequest $request, Collaborator $collaborator)
    {
        //
    }

    
    public function destroy(Collaborator $collaborator)
    {
        //
    }
}
