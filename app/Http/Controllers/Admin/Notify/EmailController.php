<?php

namespace App\Http\Controllers\Admin\Notify;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Notify\EmailRequest;
use App\Http\Services\Message\Email\EmailService;
use App\Http\Services\Message\MessageService;
use App\Models\Notify\Email;
use App\Models\User;

class EmailController extends Controller
{
    public function index()
    {
        $emails = Email::orderby('created_at', 'desc')->simplePaginate(15);
        return view('admin.notify.email.index', compact('emails'));
    }

    public function create()
    {
        return view('admin.notify.email.create');
    }

    public function store(EmailRequest $request)
    {
        $inputs = $request->validated();
        //date fixed
        $realTimestampStart = substr($request->published_at, 0, 10);
        $inputs['published_at'] = date("Y-m-d H:i:s", (int)$realTimestampStart);

        Email::create($inputs);
        return redirect()->route('admin.notify.email.index')->with('swal-success', 'ایمیل شما با موفقیت ثبت شد');
    }

    public function edit(Email $email)
    {
        return view('admin.notify.email.edit', compact('email'));
    }

    public function update(EmailRequest $request, Email $email)
    {
        $inputs = $request->validated();

        //date fixed
        $realTimestampStart = substr($request->published_at, 0, 10);
        $inputs['published_at'] = date("Y-m-d H:i:s", (int)$realTimestampStart);

        $email->update($inputs);
        return redirect()->route('admin.notify.email.index')->with('swal-success', 'ایمیل با موفقیت ویرایش شد');
    }

    public function destroy(Email $email)
    {
        $email->delete();
        return redirect()->route('admin.notify.email.index')->with('swal-success', 'ایمیل با موفقیت حذف شد');
    }

    public function status(Email $email)
    {
        $email->status = $email->status == 0 ? 1 : 0;
        $result = $email->save();
        if ($result) {
            if ($email->status == 0) {
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

    public function sendMail(Email $email, EmailService $emailService)
    {
        $email->load(['files' => function ($query) {
            $query->status(1);
        }]);
        $users = User::find($email->user_ids);
        $details = [
            'title' => $email->subject,
            'body' => $email->body,
        ];
        foreach ($users as $user) {
            $emailService->setDeatail($details);
            $emailService->setFrom('noreply@example.com', 'example');
            $emailService->setSubject($email->subject);
            $emailService->setTo($user->email);
            if ($email->files->isNotEmpty()) $emailService->setEmailFiles($email->files->pluck('file_path')->toArray());
            $messagesService = new MessageService($emailService);
            $messagesService->send();
        }
        return redirect()->route('admin.notify.email.index')->with('swal-success', 'ایمیل با موفقیت ارسال شد');
    }
}
