<?php

namespace App\Jobs;

use App\Models\User;
use App\Service\MailService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class MailJob implements ShouldQueue
{
    use Queueable;

    private object $message;
    public function __construct($message)
    {
        $this->message = $message;
    }


    public function handle(): void
    {
        $mail = new MailService();
        $mail->create($this->message);
    }
}
