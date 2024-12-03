<?php

namespace App\Console\Commands;

use App\Service\RabbitMQService;
use App\Service\YougileService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ReportConsumeCommand extends Command
{
    protected $signature = 'app:report-consume-command';
    protected $description = 'Command description';


    public function handle()
    {
        $callback = function ($msg) {

            $columnId = '190ff3c1-7098-40d9-a046-3080a20fce07';
            $yougileService = new YougileService();
            $yougileService->send($msg, $columnId);
        };

        $queue = 'yougileRep';
        $service = new RabbitMQService;
        $service->consume($queue, $callback);
    }
}
