<?php

namespace App\Http\Controllers\Business\Tickets;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Business\Tickets\TicketCategory;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TicketCollaboratorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = Auth::User()->ticket; // se houver relacionamento

        return view('app.business.tickets.ticket_collaborator.ticket_collaborator_index', compact('tickets'));
    }

    
    public function create()
    {

        $users = User::get();
        $ticketCategories = TicketCategory::get(); 
        return view('app.business.tickets.ticket_collaborator.ticket_collaborator_create', compact('users', 'ticketCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
