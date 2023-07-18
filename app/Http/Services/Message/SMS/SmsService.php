<?php

namespace App\Http\Services\Message\SMS;

use App\Http\Interfaces\MessageInterface;
use App\Jobs\SendSmsToUser;

class SmsService implements MessageInterface
{

    private string $from;
    private string $text;
    private array $to;
    private bool $isFlash = true;


    public function fire()
    {
        SendSmsToUser::dispatch($this->getFrom(), $this->getTo(), $this->getText(), $this->getIsFlash());
    }

    public function getFrom()
    {
        return $this->from;
    }

    public function setFrom($from)
    {
        $this->from = $from;
    }


    public function getText()
    {
        return $this->text;
    }

    public function setText($text)
    {
        $this->text = $text;
    }


    public function getTo()
    {
        return $this->to;
    }

    public function setTo($to)
    {
        $this->to = $to;
    }

    public function getIsFlash()
    {
        return $this->isFlash;
    }

    public function setIsFlash($flash)
    {
        $this->isFlash = $flash;
    }


}
