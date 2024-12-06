<?php

namespace App\Console\Commands;

use App\Service\RabbitMQService;
use App\Service\YougileProblemService;
use Illuminate\Console\Command;


class ProblemConsumeCommand extends Command
{
    protected $signature = 'app:problem-consume-command';
    protected $description = 'Command description';


    public function handle()
    {
        $callback = function ($msg) {

            $columnId = '7b9e60b5-6b40-4ea3-aa6d-06c0c01f4168';
            $yougileService = new YougileProblemService();
            $yougileService->send($msg, $columnId);

        };

        $queue = 'yougileProb';
        $service = new RabbitMQService;
        $service->consume($queue, $callback);
    }
}
