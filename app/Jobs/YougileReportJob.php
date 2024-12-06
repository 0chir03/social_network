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
    public function __construct($validated, $account, $user)
    {
        $this->validated = $validated;
        $this->account = $account;
        $this->user = $user;
    }

    public function handle(): void
    {
        $yougile = new YougileService();
        $yougile->createReport($this->validated, $this->account, $this->user);
    }
}
