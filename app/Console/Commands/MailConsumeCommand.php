<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Service\RabbitMQService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class MailConsumeCommand extends Command
{

    protected $signature = 'app:mail-consume-command';
    protected $description = 'Command description';

    public function handle()
    {
        $callback = function ($msg) {
            //IDшники получателя и отправителя (внешние ключи для таблицы users)
            $idReceiver = json_decode($msg->body)->receiver_id;
            $idSender = json_decode($msg->body)->sender_id;

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
            echo "Сообщение доставлено";
        };

        $service = new RabbitMQService();
        $service->consumeMail($callback);
    }
}
