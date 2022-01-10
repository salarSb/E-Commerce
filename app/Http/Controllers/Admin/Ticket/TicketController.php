<?php

namespace App\Http\Controllers\Admin\Ticket;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Ticket\TicketAnswerRequest;
use App\Models\Ticket\Ticket;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::all();
        return view('admin.ticket.index', compact('tickets'));
    }

    public function show(Ticket $ticket)
    {
        return view('admin.ticket.show', compact('ticket'));
    }

    public function newTickets()
    {
        $tickets = Ticket::where('seen', 0)->get();
        foreach ($tickets as $ticket) {
            $ticket->update(['seen' => 1]);
        }
        return view('admin.ticket.index', compact('tickets'));
    }

    public function openTickets()
    {
        $tickets = Ticket::where('status', 0)->get();
        return view('admin.ticket.index', compact('tickets'));
    }

    public function closeTickets()
    {
        $tickets = Ticket::where('status', 1)->get();
        return view('admin.ticket.index', compact('tickets'));
    }

    public function change(Ticket $ticket)
    {
        if ($ticket->status == 1) {
            $ticket->update(['status' => 0]);
            return redirect()->route('admin.ticket.index')->with('swal-success', 'تیکت با موفقیت باز شد');
        } else {
            $ticket->update(['status' => 1]);
            return redirect()->route('admin.ticket.index')->with('swal-success', 'تیکت با موفقیت بسته شد');
        }
    }

    public function answer(TicketAnswerRequest $request, Ticket $ticket)
    {
        $inputs = $request->all();
        $inputs['subject'] = $ticket->subject;
        $inputs['description'] = $request->input('description');
        $inputs['seen'] = 1;
        $inputs['reference_id'] = $ticket->reference_id;
        $inputs['user_id'] = 7;
        $inputs['category_id'] = $ticket->category_id;
        $inputs['priority_id'] = $ticket->priority_id;
        $inputs['ticket_id'] = $ticket->id;
        Ticket::create($inputs);
        return redirect()->route('admin.ticket.index')->with('swal-success', 'پاسخ شما با موفقیت ثبت شد');
    }
}
