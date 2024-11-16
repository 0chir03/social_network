<?php

namespace App\Listeners;

use App\Events\SubscriberEvent;

class SendListener
{
    public function handle(SubscriberEvent $event): void
    {
        //dd($event);
    }
}
