<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriberController
{


    //друзья авторизованного пользователя и запросы на добавление
    public function showSubscribers()
    {
        //друзья пользователя
        $subscribers = Subscriber::query()->where('user_id', Auth::id())->get();

        //на кого подписан и отправлены заявки(если есть)
        $requests = Subscriber::query()->where('account_id', Auth::user()->account->id)->get();

        $usersObjRequest = [];
        foreach($requests as $item){
            $userIdRequest = $item->user_id;
            $accountIdRequest = Account::query()->where('user_id', '=', $userIdRequest)->select('id')->get();

            $userObjRequest = Account::query()->join('subscribers', 'accounts.user_id', '=', 'subscribers.user_id')
                                              ->join('photos', 'accounts.id', '=', 'photos.account_id')
                                              ->where('accounts.user_id', '=', $userIdRequest)
                                              ->where('accounts.id', '=', $accountIdRequest[0]->id)
                                              ->get();
            $usersObjRequest[] = $userObjRequest;
        }

        return view('subscribers.subscribers', ['subscribers' => $subscribers,
                                                     'usersObjRequest' => $usersObjRequest,
        ]);
    }

    //потверждение заявки в друзья
    public function accept(Request $request)
    {
        //Валидация
        $validated = $request->validate([
            'user_id' => 'required|integer',
        ]);

        Subscriber::query()->where('user_id', $validated['user_id'])->update(['accepted' => true]);

        return view ('success');
    }

}
