<?php

namespace App\Jobs;

use App\Service\RabbitMQService;
use App\Service\YougileService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;

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
        Http::withToken('6WxXQlOvkRnkPZyB15XEW3PdSHIp2sOmfPPA2lNoLJ3ZOLXcL2eQCRB+JOgK1lNA')
            ->post('https://ru.yougile.com/api-v2/tasks', [
                'title' => $this->data['account']->first_name . ' ' . $this->data['account']->last_name,
                'columnId' => '7b9e60b5-6b40-4ea3-aa6d-06c0c01f4168',
                'description' => $this->data['validated']->content,
                'color' => 'task-red'
            ]);
    }
}
