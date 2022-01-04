<?php

namespace App\Http\Controllers\Admin\Ticket;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Ticket\TicketCategoryAndPriorityRequest;
use App\Models\Ticket\TicketPriority;

class TicketPriorityController extends Controller
{
    public function index()
    {
        $ticketPriorities = TicketPriority::all();
        return view('admin.ticket.priority.index', compact('ticketPriorities'));
    }

    public function create()
    {
        return view('admin.ticket.priority.create');
    }

    public function store(TicketCategoryAndPriorityRequest $request)
    {
        $inputs = $request->all();
        TicketPriority::create($inputs);
        return redirect()->route('admin.ticket.priority.index')->with('swal-success', 'اولویت جدید برای تیکت ها با موفقیت ساخته شد');
    }

    public function show()
    {
        //
    }

    public function edit(TicketPriority $ticketPriority)
    {
        return view('admin.ticket.priority.edit', compact('ticketPriority'));
    }

    public function update(TicketCategoryAndPriorityRequest $request, TicketPriority $ticketPriority)
    {
        $inputs = $request->all();
        $ticketPriority->update($inputs);
        return redirect()->route('admin.ticket.priority.index')->with('swal-success', 'اولویت برای تیکت ها با موفقیت ویرایش شد');
    }

    public function destroy(TicketPriority $ticketPriority)
    {
        $ticketPriority->delete();
        return redirect()->route('admin.ticket.priority.index')->with('swal-success', 'اولویت تیکت با موفقیت حذف شد');
    }

    public function status(TicketPriority $ticketPriority)
    {
        $ticketPriority->status = $ticketPriority->status == 0 ? 1 : 0;
        $result = $ticketPriority->save();
        if ($result) {
            if ($ticketPriority->status == 0) {
                return response()->json([
                    'status' => true,
                    'checked' => false
                ]);
            } else {
                return response()->json([
                    'status' => true,
                    'checked' => true
                ]);
            }
        } else {
            return response()->json([
                'status' => false
            ]);
        }
    }
}
