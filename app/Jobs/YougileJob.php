<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;

class YougileJob implements ShouldQueue
{
    use Queueable;
    private $validated;
    private $account;
    private $columnId;
    public function __construct($validated, $account, $columnId)
    {
        $this->validated = $validated;
        $this->account = $account;
        $this->columnId = $columnId;
    }

    public function handle(): void
    {
        Http::withToken('6WxXQlOvkRnkPZyB15XEW3PdSHIp2sOmfPPA2lNoLJ3ZOLXcL2eQCRB+JOgK1lNA')
            ->post('https://ru.yougile.com/api-v2/tasks', [
                'title' => $this->account->first_name . ' ' . $this->account->last_name,
                'columnId' => $this->columnId,
                'description' => $this->validated['content'],
                'color' => 'task-red'
            ]);
    }
}
