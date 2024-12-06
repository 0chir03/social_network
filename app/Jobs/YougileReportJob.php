<?php

namespace App\Jobs;

use App\Service\YougileService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class YougileReportJob implements ShouldQueue
{
    use Queueable;
    private array $validated;
    private object $account;
    private object $user;
    private YougileService $yougile;
    public function __construct($validated, $account, $user)
    {
        $this->validated = $validated;
        $this->account = $account;
        $this->user = $user;
        $this->yougile = new YougileService();
    }

    public function handle(): void
    {
        $this->yougile->createReport($this->validated, $this->account, $this->user);
    }
}
