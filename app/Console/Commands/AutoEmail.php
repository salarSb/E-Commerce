<?php

namespace App\Console\Commands;

use App\Http\Services\Message\Email\EmailService;
use App\Http\Services\Message\MessageService;
use App\Models\Notify\Email;
use App\Models\User;
use Illuminate\Console\Command;

class AutoEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:send-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send emails by published_at date';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(EmailService $emailService)
    {
        $emailsToSend = Email::status(1)->where('published_at', '2023-07-03 18:46:38')->get();
        if ($emailsToSend->isNotEmpty()) {
            foreach ($emailsToSend as $emailToSend) {
                $users = User::find($emailToSend->user_ids);
                $details = [
                    'title' => $emailToSend->subject,
                    'body' => $emailToSend->body,
                ];
                foreach ($users as $user) {
                    $emailService->setDeatail($details);
                    $emailService->setFrom('noreply@example.com', 'example');
                    $emailService->setSubject($emailToSend->subject);
                    $emailService->setTo($user->email);
                    $messagesService = new MessageService($emailService);
                    $messagesService->send();
                }
            }
        }
        return 0;
    }
}
