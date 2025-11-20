<?php

namespace App\Services;

use App\Mail\GenericMail;
use Illuminate\Support\Facades\Mail;

class MailService
{
    public static function send(string $to, string $subject, string $body)
    {
        Mail::to($to)->send(new GenericMail($subject, $body));
    }

    public static function sendAndQueue(string $to, string $subject, string $body): bool
    {
        Mail::to($to)->queue(new GenericMail($subject, $body));

        return true;
    }
}
