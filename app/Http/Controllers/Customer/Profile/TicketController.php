<?php

namespace App\Http\Controllers\Customer\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\Profile\TicketAnswerRequest;
use App\Models\Ticket\Ticket;
use App\Models\Ticket\TicketCategory;
use App\Models\Ticket\TicketPriority;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $query = auth()->user()->tickets()->orderBy('id', 'desc');
        $type = $request->query('type');
        $tickets = isset($type) ? $query->where('status', $type)->get() : $query->get();
        return view('customer.profile.ticket.index', compact('tickets'));
    }

    public function create()
    {
        // TODO : add display_name and name to ticket categories and priorities {better to do it in all categories in project for example in products and posts and etc.}.
        $ticketCategories = TicketCategory::valid()->get();
        $ticketPriorities = TicketPriority::valid()->get();
        return view('customer.profile.ticket.create', compact('ticketCategories', 'ticketPriorities'));
    }

    public function show(Ticket $ticket)
    {
        $ticketAnswers = $ticket->children;
        return view('customer.profile.ticket.show', compact('ticket', 'ticketAnswers'));
    }

    public function change(Ticket $ticket)
    {
        if ($ticket->status == 1) {
            $ticket->update(['status' => 0]);
            return back()->with('swal-success', 'تیکت با موفقیت باز شد');
        }
        $ticket->update(['status' => 1]);
        return back()->with('swal-success', 'تیکت با موفقیت بسته شد');
    }

    public function answer(TicketAnswerRequest $request, Ticket $ticket)
    {
        $inputs = $request->all();
        $inputs['subject'] = $ticket->subject;
        $inputs['description'] = $request->input('description');
        $inputs['seen'] = 0;
        $inputs['reference_id'] = $ticket->reference_id;
        $inputs['user_id'] = auth()->id();
        $inputs['category_id'] = $ticket->category_id;
        $inputs['priority_id'] = $ticket->priority_id;
        $inputs['ticket_id'] = $ticket->id;
        Ticket::create($inputs);
        return redirect()->back()->with('swal-success', 'پاسخ شما با موفقیت ثبت شد');
    }
}
