<?php

namespace App\Console\Commands;

use App\Service\RabbitMQService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ProblemConsumeCommand extends Command
{
    protected $signature = 'app:problem-consume-command';
    protected $description = 'Command description';


    public function handle()
    {
        $callback = function ($msg) {

            $msg = json_decode($msg->body);

            Http::withToken('6WxXQlOvkRnkPZyB15XEW3PdSHIp2sOmfPPA2lNoLJ3ZOLXcL2eQCRB+JOgK1lNA')
                ->post('https://ru.yougile.com/api-v2/tasks', [
                    'title' => $msg->account->first_name . ' ' . $msg->account->last_name,
                    'columnId' => '7b9e60b5-6b40-4ea3-aa6d-06c0c01f4168',
                    'description' => $msg->validated->content,
                    'color' => 'task-red'
                ]);

            echo "Сообщение доставлено";
        };
        $service = new RabbitMQService;
        $service->consumeProblem($callback);
    }

}
