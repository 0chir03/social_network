<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class MailJob implements ShouldQueue
{
    use Queueable;

    private $message;
    public function __construct($message)
    {
        $this->message = $message;
    }


    public function handle(): void
    {
        //IDшники получателя и отправителя (внешние ключи для таблицы users)
        $idReceiver = $this->message->receiver_id;
        $idSender = $this->message->sender_id;

        //объекты получателя и отправителя
        $userReceiver = User::query()->find($idReceiver);
        $userSender = User::query()->find($idSender);

        //массив данных для передачи во view
        $data = array('name'=>$userReceiver->account->first_name);

        Mail::send(['text'=>'mail'], $data, function($message) use ($userReceiver, $userSender) {
            $message->to($userReceiver->email, $userReceiver->account->first_name)->subject
            ('Laravel Basic Testing Mail');
            $message->from($userSender->email, $userSender->account->first_name);
        });
    }
}
