<?php

namespace App\Service;

use App\Models\User;
use Illuminate\Support\Facades\Mail;

class MailService
{
    public function create(object $message): void
    {
        //ID получателя и отправителя (внешние ключи для таблицы users)
        $idReceiver = $message->receiver_id;
        $idSender = $message->sender_id;

        //объекты получателя и отправителя
        $userReceiver = User::query()->find($idReceiver);
        $userSender = User::query()->find($idSender);

        //массив данных для передачи во view
        $data = array('name' => $userReceiver->account->first_name);

        Mail::send(['text' => 'mail'], $data, function ($message) use ($userReceiver, $userSender) {
            $message->to($userReceiver->email, $userReceiver->account->first_name)->subject
            ('Laravel Basic Testing Mail');
            $message->from($userSender->email, $userSender->account->first_name);
        });
    }
}
