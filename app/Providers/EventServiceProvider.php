<?php

namespace App\Providers;

use App\Events\MessageEvent;
use App\Listeners\SendListener;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        MessageEvent::class => [
            SendListener::class,
        ]
    ];
}
