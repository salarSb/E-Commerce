<?php

namespace App\Http\Controllers\Admin\Ticket;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index(): Factory|View|Application
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

    public function show(): Factory|View|Application
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

    public function newTickets(): Factory|View|Application
    {
        return view('admin.ticket.index');
    }

    public function openTickets(): Factory|View|Application
    {
        return view('admin.ticket.index');
    }

    public function closeTickets(): Factory|View|Application
    {
        return view('admin.ticket.index');
    }
}
