<?php

namespace App\Http\Services\Message\Email;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailViewProvider extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public array $details;
    public array|null $files;

    public function __construct($details, $subject, $from, $files = null)
    {
        $this->details = $details;
        $this->subject = $subject;
        $this->from = $from;
        $this->files = $files;
    }

    public function build(): MailViewProvider
    {
        return $this->subject($this->subject)->view('emails.send_otp');
    }

    public function attachments(): array
    {
        if ($this->files) {
            $publicFiles = [];
            foreach ($this->files as $file) {
                $publicFiles[] = public_path($file);
            }
            return $publicFiles;
        }
        return [];
    }
}
