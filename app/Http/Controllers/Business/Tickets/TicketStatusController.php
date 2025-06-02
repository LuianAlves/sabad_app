<?php

namespace App\Http\Controllers\Business\Tickets;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Business\Tickets\Ticket;
use Carbon\Carbon;

class TicketStatusController extends Controller
{
    public function openToInProgress($ticketId)
    {
        $ticket = Ticket::where('id', $ticketId)->first();

        if ($ticket->status == 'open') { // se ticket->status
            $ticket->update([
                'status' => 'in progress',
                'updated_at' => Carbon::now()
            ]);
        } else if ($ticket->status == 'in progress') {
            $ticket->update([
                'status' => 'completed',
                'updated_at' => Carbon::now()
            ]);
        } else if ($ticket->status == 'completed') {
            $ticket->update([
                'status' => 'canceled',
                'updated_at' => Carbon::now()
            ]);
        } else {
            $ticket->update([
                'status' => 'open',
                'updated_at' => Carbon::now()
            ]);
        }

        return redirect()->back();
    }
}
