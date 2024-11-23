<?php

namespace App\Listeners;

use App\Events\MessageEvent;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SendListener
{
    /**
     * Handle the event.
     */
    public function handle(MessageEvent $event): void
    {
        $idReceiver = $event->message->receiver_id;
        $userReceiver = User::query()->find($idReceiver);

        $data = array('name'=>$userReceiver->account->first_name);

        Mail::send(['text'=>'mail'], $data, function($message) use ($userReceiver) {
            $message->to($userReceiver->email, $userReceiver->account->first_name)->subject
            ('Laravel Basic Testing Mail');
            $message->from(Auth::user()->email, Auth::user()->account->first_name);
        });
        echo "Сообщение доставлено";
    }
}
