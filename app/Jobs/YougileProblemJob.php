<?php

namespace App\Jobs;

use App\Service\YougileService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class YougileProblemJob implements ShouldQueue
{
    use Queueable;
    public function __construct(
        private array $validated,
        private object $account,
        private YougileService $yougile
    ) {}

    public function handle(): void
    {
        $this->yougile->createProblem($this->validated, $this->account);
    }
}
