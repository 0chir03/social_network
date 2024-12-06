<?php

namespace App\Jobs;

use App\Service\YougileService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class YougileProblemJob implements ShouldQueue
{
    use Queueable;
    private array $validated;
    private object $account;
    private YougileService $yougile;
    public function __construct($validated, $account)
    {
        $this->validated = $validated;
        $this->account = $account;
        $this->yougile = new YougileService();
    }

    public function handle(): void
    {
        $this->yougile->createProblem($this->validated, $this->account);
    }
}
