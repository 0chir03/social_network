<?php

namespace App\Jobs;

use App\Service\YougileService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class YougileReportJob implements ShouldQueue
{
    use Queueable;

    public function __construct(
        private array $validated,
        private object $account,
        private object $user,
        private YougileService $yougile
    )
    {}

    public function handle(): void
    {
        $this->yougile->createReport($this->validated, $this->account, $this->user);
    }
}
