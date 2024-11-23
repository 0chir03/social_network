<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;

class MailController

{
    public function basic_email($emailSender, $emailReceiver) {

        $data = array('name'=>"Virat Gandhi");

        Mail::send(['text'=>'mail'], $data, function($message) use ($emailReceiver, $emailSender) {
            $message->to($emailReceiver, 'Tutorials Point')->subject
            ('Laravel Basic Testing Mail');
            $message->from($emailSender,'Virat Gandhi');
        });
        echo "Сообщение доставлено";
    }
}
