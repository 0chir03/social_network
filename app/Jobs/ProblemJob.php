<?php

namespace App\Jobs;

use App\Service\RabbitMQService;
use App\Service\YougileService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProblemJob implements ShouldQueue
{
    use Queueable;
    private $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function handle(): void
    {
        $callback = function ($msg) {

            $columnId = '7b9e60b5-6b40-4ea3-aa6d-06c0c01f4168';
            $yougileService = new YougileService();
            $yougileService->send($msg, $columnId);

        };
        $queue = 'yougileProb';
        $service = new RabbitMQService;
        $service->consume($queue, $callback);
    }
}
