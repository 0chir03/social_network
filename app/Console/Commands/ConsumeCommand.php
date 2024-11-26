<?php

namespace App\Console\Commands;

require_once __DIR__ . '/../../../vendor/autoload.php';

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use PhpAmqpLib\Connection\AMQPStreamConnection;
class ConsumeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rabbitmq:consume';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $connection = new AMQPStreamConnection('rabbitmq', 5672, 'rmuser', 'rmpassword');
        $channel = $connection->channel();

        $channel->queue_declare('hello', false, false, false, false);

        echo " [*] Waiting for messages. To exit press CTRL+C\n";

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

        $channel->basic_consume('hello', '', false, true, false, false, $callback);

        try {
            $channel->consume();
        } catch (\Throwable $exception) {
            echo $exception->getMessage();
        }
    }
}
