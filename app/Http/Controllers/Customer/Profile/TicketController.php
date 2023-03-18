<?php

namespace App\Http\Controllers\Customer\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\Profile\StoreTicketRequest;
use App\Http\Requests\Customer\Profile\TicketAnswerRequest;
use App\Http\Services\File\FileService;
use App\Models\Ticket\Ticket;
use App\Models\Ticket\TicketCategory;
use App\Models\Ticket\TicketPriority;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $query = auth()->user()->tickets()->orderBy('id', 'desc')->whereNull('ticket_id');
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

    public function store(StoreTicketRequest $request, FileService $fileService)
    {
        $user = auth()->user();
        $inputs = $request->validated();
        $inputs['reference_id'] = 2;
        DB::beginTransaction();
        try {
            $ticket = $user->tickets()->create($inputs);

            //file
            if ($request->hasFile('file')) {
                $fileService->setExclusiveDirectory('files' . DIRECTORY_SEPARATOR . 'ticket-files');
                $fileService->setFileSize($request->file('file'));
                $fileSize = $fileService->getFileSize();
                $result = $fileService->moveToPublic($request->file('file'));
                $fileFormat = $fileService->getFileFormat();
                if ($result === false) {
                    return back()->with('swal-error', 'آپلود فایل با خطا مواجه شد');
                }
                $inputs['file_path'] = $result;
                $inputs['file_size'] = $fileSize;
                $inputs['file_type'] = $fileFormat;
                $inputs['status'] = 1;
                $inputs['ticket_id'] = $ticket->id;
            }
            $user->ticketFiles()->create($inputs);
            DB::commit();
            return to_route('profile.my-tickets.index')->with('swal-success', 'تیکت شما با موفقیت ثبت شد');
        } catch (\Exception $exception) {
            DB::rollBack();
            return to_route('profile.my-tickets.index')->with('swal-error', 'ثبت تیکت با خطا مواجه شد');
        }
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

    public function download(Ticket $ticket)
    {
        if ($ticket->ticketFile) {
            $filePath = public_path($ticket->ticketFile->file_path);
            return response()->download($filePath);
        }
        return to_route('profile.my-tickets.show', $ticket->id)->with('swall-error', 'برای این تیکت فایلی وجود ندارد');
    }
}
