<?php

namespace App\Http\Controllers\Business\Tickets;

use App\Http\Controllers\Controller;


use App\Models\Business\Tickets\Ticket;
use App\Http\Requests\Business\Tickets\StoreTicketRequest;
use App\Http\Requests\Business\Tickets\UpdateTicketRequest;
use App\Models\Business\Tickets\TicketCategory;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::latest()->with('ticketCategory')->get();
        $ticketCategories = TicketCategory::get(); // Assim
        $statusData = [
            'open' => [
                'label' => 'Em aberto',
                'count' => $tickets->where('status', 'open')->count(),
                'latest' => $tickets->where('status', 'open')->first(),
            ],
            'in progress' => [
                'label' => 'Em andamento',
                'count' => $tickets->where('status', 'in progress')->count(),
                'latest' => $tickets->where('status', 'in progress')->first(),
            ],
            'completed' => [
                'label' => 'Concluído',
                'count' => $tickets->where('status', 'completed')->count(),
                'latest' => $tickets->where('status', 'completed')->first(),
            ],
            'canceled' => [
                'label' => 'Cancelado',
                'count' => $tickets->where('status', 'canceled')->count(),
                'latest' => $tickets->where('status', 'canceled')->first(),
            ],
        ];

        $icons = [
            'open' => ['icon' => 'fa-envelope-open-text', 'bg' => 'info'],
            'in progress' => ['icon' => 'fa-spinner', 'bg' => 'warning'],
            'completed' => ['icon' => 'fa-check-circle', 'bg' => 'success'],
            'canceled' => ['icon' => 'fa-times-circle', 'bg' => 'danger'],
        ];

        return view('app.business.tickets.ticket.ticket_index', compact('tickets', 'ticketCategories', 'statusData', 'icons'));
    }

    public function create()
    {
        $users = User::get();
        $ticketCategories = TicketCategory::get(); // Assim

        return view('app.business.tickets.ticket.ticket_create', compact('users', 'ticketCategories'));
    }

    public function store(StoreTicketRequest $request)
    {
        $request->validated();

        $isAdmin = Auth::user()->hasRole('admin');

        $ticket = Ticket::create([
            'user_id' => $request->user_id,
            'ticket_category_id' => $request->ticket_category_id,
            'title' => $request->title,
            'descreption' => $request->descreption,

        ]);
        
        if ($isAdmin)
        {
            return redirect()->route('ticket.index');
        }
        else
        {
            return redirect()->route('ticket.collaborator.index');
        }
        

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

        ]);

        return redirect()->route('ticket.index');
    }

    public function nextStatus(Ticket $ticket)
    {
        $statuses = ['open', 'in progress', 'completed', 'canceled'];
        $currentIndex = array_search($ticket->status, $statuses);
        $nextIndex = ($currentIndex + 1) % count($statuses);
        $ticket->status = $statuses[$nextIndex];
        $ticket->save();

        return redirect()->back()->with('success', 'Status atualizado para ' . $statuses[$nextIndex]);
    }



    public function destroy($id)
    {
        $ticket = Ticket::find($id);
        $ticket->delete();

        return redirect()->route('ticket.index');
    }
}
