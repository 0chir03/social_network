<?php

namespace App\Providers;

use App\Events\FriendRequest;
use App\Listeners\SendFriendRequest;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
