<?php

namespace App\Console\Commands;

use App\Service\RabbitMQService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ReportConsumeCommand extends Command
{
    protected $signature = 'app:report-consume-command';

    protected $description = 'Command description';


    public function handle()
    {
        $callback = function ($msg) {

            $msg = json_decode($msg->body);

            Http::withToken('6WxXQlOvkRnkPZyB15XEW3PdSHIp2sOmfPPA2lNoLJ3ZOLXcL2eQCRB+JOgK1lNA')
                ->post('https://ru.yougile.com/api-v2/tasks', [
                    'title' => $msg->account->first_name . ' ' . $msg->account->last_name,
                    'columnId' => '190ff3c1-7098-40d9-a046-3080a20fce07',
                    'description' => $msg->validated->content,
                    'color' => 'task-red'
                ]);

            echo "Сообщение доставлено";
        };
        $service = new RabbitMQService;
        $service->consumeReport($callback);
    }

}
