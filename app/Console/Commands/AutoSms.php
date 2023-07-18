<?php

namespace App\Console\Commands;

use App\Http\Services\Message\MessageService;
use App\Http\Services\Message\SMS\SmsService;
use App\Models\Notify\SMS;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;

class AutoSms extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:send-sms';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send sms by published_at date';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(SmsService $smsService)
    {
        $smsToSends = SMS::status(1)->where('published_at', now())->get();
        if ($smsToSends->isNotEmpty()) {
            foreach ($smsToSends as $smsToSend) {
                $users = User::find($smsToSend->user_ids);
                foreach ($users as $user) {
                    $smsService->setFrom(Config::get('sms.from'));
                    $smsService->setTo(['0' . $user->mobile]);
                    $smsService->setText($smsToSend->title . "\n" . $smsToSend->body);
                    $smsService->setIsFlash(true);
                    $messagesService = new MessageService($smsService);
                    $messagesService->send();
                }
            }
        }
        return 0;
    }
}
