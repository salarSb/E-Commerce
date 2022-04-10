<?php

namespace App\Http\Services\Message\Email;

use App\Http\Interfaces\MessageInterface;
use Illuminate\Support\Facades\Mail;

class EmailService implements MessageInterface
{
    private $detail;
    private $subject;
    private $from = [
        ['address' => null, 'name' => null,],
    ];
    private $to;

    public function fire()
    {
        Mail::to($this->to)->send(new MailViewProvider($this->detail, $this->subject, $this->from));
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
}
