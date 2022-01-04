<?php

namespace App\Http\Controllers\Admin\Ticket;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Ticket\TicketCategoryAndPriorityRequest;
use App\Models\Ticket\TicketCategory;

class TicketCategoryController extends Controller
{
    public function index()
    {
        $ticketCategories = TicketCategory::all();
        return view('admin.ticket.category.index', compact('ticketCategories'));
    }

    public function create()
    {
        return view('admin.ticket.category.create');
    }

    public function store(TicketCategoryAndPriorityRequest $request)
    {
        $inputs = $request->all();
        TicketCategory::create($inputs);
        return redirect()->route('admin.ticket.category.index')->with('swal-success', 'دسته بندی جدید برای تیکت ها با موفقیت ساخته شد');
    }

    public function show()
    {
        //
    }

    public function edit(TicketCategory $ticketCategory)
    {
        return view('admin.ticket.category.edit', compact('ticketCategory'));
    }

    public function update(TicketCategoryAndPriorityRequest $request, TicketCategory $ticketCategory)
    {
        $inputs = $request->all();
        $ticketCategory->update($inputs);
        return redirect()->route('admin.ticket.category.index')->with('swal-success', 'دسته بندی برای تیکت ها با موفقیت ویرایش شد');
    }

    public function destroy(TicketCategory $ticketCategory)
    {
        $ticketCategory->delete();
        return redirect()->route('admin.ticket.category.index')->with('swal-success', 'دسته بندی تیکت با موفقیت حذف شد');
    }

    public function status(TicketCategory $ticketCategory)
    {
        $ticketCategory->status = $ticketCategory->status == 0 ? 1 : 0;
        $result = $ticketCategory->save();
        if ($result) {
            if ($ticketCategory->status == 0) {
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
