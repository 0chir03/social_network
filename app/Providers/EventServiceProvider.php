<?php

namespace App\Providers;

use App\Events\SubscriberEvent;
use App\Listeners\SendListener;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
  /*  protected $listen =[
        SubscriberEvent::class => [
            SendListener::class,
        ]
    ];*/

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Event::listen(SubscriberEvent::class,
                      SendListener::class);
    }
}
