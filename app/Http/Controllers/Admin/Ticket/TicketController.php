<?php

namespace App\Http\Controllers\Admin\Ticket;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        return view('admin.ticket.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show()
    {
        return view('admin.ticket.show');
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function newTickets()
    {
        return view('admin.ticket.index');
    }

    public function openTickets()
    {
        return view('admin.ticket.index');
    }

    public function closeTickets()
    {
        return view('admin.ticket.index');
    }
}
