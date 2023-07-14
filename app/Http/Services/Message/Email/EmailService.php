<?php

namespace App\Http\Services\Message\Email;

use App\Http\Interfaces\MessageInterface;
use App\Jobs\SendEmailToUser;

class EmailService implements MessageInterface
{
    private array $detail;
    private string $subject;
    private array $from = [
        ['address' => null, 'name' => null,],
    ];
    private string $to;
    private ?array $emailFiles = null;

    public function fire()
    {
        SendEmailToUser::dispatch($this->detail, $this->subject, $this->from, $this->to, $this->emailFiles);
    }

    public function getDetails()
    {
        return $this->detail;
    }

    public function setDeatail($details)
    {
        $this->detail = $details;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    public function getFrom()
    {
        return $this->from;
    }

    public function setFrom($address, $name)
    {
        $this->from = [
            [
                'address' => $address,
                'name' => $name
            ]
        ];
    }

    public function getTo()
    {
        return $this->to;
    }

    public function setTo($to)
    {
        $this->to = $to;
    }

    public function getEmailFiles()
    {
        return $this->emailFiles;
    }

    public function setEmailFiles($emailFiles)
    {
        $this->emailFiles = $emailFiles;
    }
}
