<?php

namespace App\Http\Controllers\Business\Ticket;

use App\Http\Controllers\Controller;


use App\Models\Business\Ticket;
use App\Http\Requests\BuStoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;

class TicketController extends Controller
{
    
    public function index()
    {
        $tickets = Ticket::get();

        return view('app.tickets.ticket.ticket_index', compact('tickets'));

    }

    
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}
