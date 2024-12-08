<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class RedisCommand extends Command
{
    protected $signature = 'app:redis';

    protected $description = 'Command description';

    public function handle()
    {
        Cache::put('key', 'value', $seconds = 10);
    }
}
