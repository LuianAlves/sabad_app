<?php

namespace App\Http\Controllers\Business\Tickets;

use App\Http\Controllers\Controller;


use App\Models\Business\Tickets\TicketCategory;
use App\Http\Requests\Business\Tickets\TicketCategory\StoreTicketCategoryRequest;
use App\Http\Requests\Business\Tickets\TicketCategory\UpdateTicketCategoryRequest;

class TicketCategoryController extends Controller
{
    
    public function index()
    {
        //
    }

    
    public function create()
    {
        $category = TicketCategory::get();

        return view('app.business.tickets.ticket_category.ticket_category_create');
    }

    
    public function store(StoreTicketCategoryRequest $request)
    {
        //
    }

    
    public function show(TicketCategory $ticketCategory)
    {
        //
    }

    
    public function edit(TicketCategory $ticketCategory)
    {
        //
    }

    
    public function update(UpdateTicketCategoryRequest $request, TicketCategory $ticketCategory)
    {
        //
    }

    
    public function destroy(TicketCategory $ticketCategory)
    {
        //
    }
}
