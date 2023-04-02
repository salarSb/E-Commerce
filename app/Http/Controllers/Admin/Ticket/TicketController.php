<?php

namespace App\Http\Controllers\Admin\Ticket;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Ticket\TicketAnswerRequest;
use App\Http\Services\File\FileService;
use App\Models\Ticket\Ticket;
use App\Traits\TicketHasFile;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    use TicketHasFile;

    public function __construct()
    {
        $this->middleware('role.permission:answer_ticket')->only(['answer']);
    }

    public function index()
    {
        $tickets = Ticket::whereNull('ticket_id')->get();
        return view('admin.ticket.index', compact('tickets'));
    }

    public function show(Ticket $ticket)
    {
        $ticketAnswers = $ticket->children;
        return view('admin.ticket.show', compact('ticket', 'ticketAnswers'));
    }

    public function newTickets()
    {
        $tickets = Ticket::where('seen', 0)->whereNull('ticket_id')->get();
        foreach ($tickets as $ticket) {
            $ticket->update(['seen' => 1]);
        }
        return view('admin.ticket.index', compact('tickets'));
    }

    public function openTickets()
    {
        $tickets = Ticket::where('status', 0)->whereNull('ticket_id')->get();
        return view('admin.ticket.index', compact('tickets'));
    }

    public function closeTickets()
    {
        $tickets = Ticket::where('status', 1)->whereNull('ticket_id')->get();
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

    public function answer(TicketAnswerRequest $request, Ticket $ticket, FileService $fileService)
    {
        DB::beginTransaction();
        try {
            $inputs = $request->all();
            $inputs['subject'] = $ticket->subject;
            $inputs['description'] = $request->input('description');
            $inputs['seen'] = 1;
            $inputs['user_id'] = auth()->id();
            $inputs['category_id'] = $ticket->category_id;
            $inputs['priority_id'] = $ticket->priority_id;
            $inputs['ticket_id'] = $ticket->id;
            $answerTicket = Ticket::create($inputs);
            if ($request->hasFile('file')) {
                $this->setFileService($fileService)->moveFileAndSetData(
                    'files' . DIRECTORY_SEPARATOR . 'ticket-files',
                    $request->file('file')
                );
                if ($this->fileMoveResult === false) {
                    return back()->with('swal-error', 'آپلود فایل با خطا مواجه شد');
                }
                $this->createTicketFile($answerTicket->id);
            }
            $ticket->update([
                'reference_id' => auth()->user()->ticketAdmin->id,
                'status' => 1,
            ]);
            DB::commit();
            return redirect()->route('admin.ticket.index')->with('swal-success', 'پاسخ شما با موفقیت ثبت شد');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->route('admin.ticket.index')->with('swal-error', 'ثبت پاسح با خطا مواجه شد');
        }

    }
}
