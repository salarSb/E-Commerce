<?php

namespace App\Http\Controllers\Admin\Notify;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Notify\SMSRequest;
use App\Http\Services\Message\MessageService;
use App\Http\Services\Message\SMS\SmsService;
use App\Models\Notify\SMS;
use App\Models\User;
use Illuminate\Support\Facades\Config;

class SMSController extends Controller
{
    public function index()
    {
        $sms = SMS::orderby('created_at', 'desc')->simplePaginate(15);
        return view('admin.notify.sms.index', compact('sms'));
    }

    public function create()
    {
        return view('admin.notify.sms.create');
    }

    public function store(SMSRequest $request)
    {
        $inputs = $request->validated();

        //date fixed
        $realTimestampStart = substr($request->published_at, 0, 10);
        $inputs['published_at'] = date("Y-m-d H:i:s", (int)$realTimestampStart);
        SMS::create($inputs);
        return redirect()->route('admin.notify.sms.index')->with('swal-success', 'پیامک شما با موفقیت ثبت شد');
    }

    public function edit(SMS $sms)
    {
        return view('admin.notify.sms.edit', compact('sms'));
    }

    public function update(SMSRequest $request, SMS $sms)
    {
        $inputs = $request->validated();

        //date fixed
        $realTimestampStart = substr($request->published_at, 0, 10);
        $inputs['published_at'] = date("Y-m-d H:i:s", (int)$realTimestampStart);

        $sms->update($inputs);
        return redirect()->route('admin.notify.sms.index')->with('swal-success', 'پیامک با موفقیت ویرایش شد');
    }

    public function destroy(SMS $sms)
    {
        $sms->delete();
        return redirect()->route('admin.notify.sms.index')->with('swal-success', 'پیامک با موفقیت حذف شد');
    }

    public function status(SMS $sms)
    {
        $sms->status = $sms->status == 0 ? 1 : 0;
        $result = $sms->save();
        if ($result) {
            if ($sms->status == 0) {
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

    public function sendSms(SMS $sms, SmsService $smsService)
    {
        $users = User::find($sms->user_ids);
        foreach ($users as $user) {
            $smsService->setFrom(Config::get('sms.from'));
            $smsService->setTo(['0' . $user->mobile]);
            $smsService->setText($sms->title . "\n" . $sms->body);
            $smsService->setIsFlash(true);
            $messagesService = new MessageService($smsService);
            $messagesService->send();
        }
        return redirect()->route('admin.notify.sms.index')->with('swal-success', 'پیامک با موفقیت ارسال شد');
    }
}
