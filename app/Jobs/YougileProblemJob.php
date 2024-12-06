<?php

namespace App\Jobs;

use App\Service\YougileService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class YougileProblemJob implements ShouldQueue
{
    use Queueable;
    private $validated;
    private $account;
    public function __construct($validated, $account)
    {
        $this->validated = $validated;
        $this->account = $account;
    }

    public function handle(): void
    {
        $yougile = new YougileService();
        $yougile->createProblem($this->validated, $this->account);
    }
}
