<?php

use Morilog\Jalali\Jalalian;

function jalaliDate($date, $format = '%A, %d %B %Y')
{
    if ($date == null) {
        return;
    }
    return Jalalian::forge($date)->format($format);
}
