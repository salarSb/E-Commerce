<?php

namespace App\Http\Controllers\Admin\Ticket;

use App\Http\Controllers\Controller;
use App\Models\User;

class TicketAdminController extends Controller
{
    public function index()
    {
        $admins = User::where('user_type', 1)->get();
        return view('admin.ticket.admin.index', compact('admins'));
    }

    public function set(User $user)
    {
        if ($user->ticketAdmin == null) {
            $user->ticketAdmin()->create([
                'user_id' => $user->id,
            ]);
            return redirect()->route('admin.ticket.admin.index')->with('swal-success', 'ادمین می تواند به تیکت ها پاسخ دهد');
        } else {
            $user->ticketAdmin()->forceDelete();
            return redirect()->route('admin.ticket.admin.index')->with('swal-success', 'دسترسی ادمین برای پاسخ به تیکت ها برداشته شد');
        }
    }
}
