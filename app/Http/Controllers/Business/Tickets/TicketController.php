<?php

namespace App\Http\Controllers\Business\Tickets;

use App\Http\Controllers\Controller;


use App\Models\Business\Tickets\Ticket;
use App\Http\Requests\Business\Tickets\StoreTicketRequest;
use App\Http\Requests\Business\Tickets\UpdateTicketRequest;
use App\Models\Business\Tickets\TicketCategory;
use App\Models\User;

class TicketController extends Controller
{
    
    public function index()
    {
        $tickets = Ticket::get();

        return view('app.business.tickets.ticket.ticket_index', compact('tickets'));

    }

    
    public function create()
    {
        $users = User::with('user')->get();
        $ticketcategories = TicketCategory::get();

        return view('app.business.tickets.ticket.ticket_create', compact('users', 'ticketcategories'));

    }

    
    public function store(StoreTicketRequest $request)
    {
        $request->validated();

        $ticket = Ticket::create([
            'user_id' => $request->user_id,
            'ticketcategory_id' => $request->ticketcategory_id,
            'title' => $request->title,
            'descreption' => $request->description,
            'opened_at' => $request->opened_at,
            'closed_at' => $request->closed_at,
            'status' => $request->status,
            'attachment_path' => $request->attachment_path
        ]);

        return redirect()->route('ticket.index');
    }

    
    public function show($id)
    {
        $ticket = Ticket::find($id);

        return view('app.business.tickets.ticket.ticket_show', compact('ticket'));
    }

   
    public function edit($id)
    {
        $ticket = Ticket::find($id);

        return view('app.business.tickets.ticket.ticket_edit', compact('ticket'));
    }

    
    public function update(UpdateTicketRequest $request, $id)
    {
        $request->validated();

        $ticket = Ticket::find($id);

        $ticket->update([
            'user_id' => $request->user_id,
            'ticketcategory_id' => $request->ticketcategory_id,
            'title' => $request->title,
            'descreption' => $request->description,
            'opened_at' => $request->opened_at,
            'closed_at' => $request->closed_at,
            'status' => $request->status,
            'attachment_path' => $request->attachment_path
        ]);

        return redirect()->route('ticket.index');
    }

    
    public function destroy($id)
    {
        $ticket = Ticket::find($id);
        $ticket->delete();

        return redirect()->route('ticket.index');
    }
}
