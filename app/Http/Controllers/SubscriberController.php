<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Support\Facades\Auth;

class SubscriberController
{
    public function showSubscribers()
    {
        //запрос всех подписчиков
        $subscribers = Subscriber::where('user_id', Auth::id())->get();
        return view('subscribers.subscribers', ['subscribers' => $subscribers,]);
    }
}
