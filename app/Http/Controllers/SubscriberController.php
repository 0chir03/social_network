<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscriberRequest;
use App\Models\Account;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SubscriberController
{


    //друзья авторизованного пользователя и запросы на добавление
    public function showSubscribers()
    {
        //друзья пользователя
        $subscribers = Subscriber::query()->where('user_id', Auth::id())->paginate(5);

        //на кого подписан (по account_id авторизованного пользователя)
        $requests = Subscriber::query()->where('account_id', Auth::user()->account->id)->get();

        //запросы на добавление в друзья
        $usersObjRequest = [];
        foreach($requests as $item){
            $userIdRequest = $item->user_id;
            //IDшники аккаунтов на которых подписан
            $accountIdRequest = Account::query()->where('user_id', '=', $userIdRequest)->select('id')->get();
            //данные из таблиц accounts, photos, subscribers
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
    public function accept(SubscriberRequest $request)
    {
        DB::beginTransaction();
        try {

            //Валидация
            $validated = $request->validated();

            //account_id заявителя по его user_id
            $idAccount = Account::query()->where('user_id', '=', $validated['user_id'])->first()->id;;

            //изменение столбца subscribers.accepted на true (потверждение в друзья, результат виден заявителю)
            Subscriber::query()->where('user_id', $validated['user_id'])->update(['accepted' => true]);

            //добавление подписчика к себе (результат виден пользователю)
            Subscriber::query()->create([
                'user_id' => Auth::id(),
                'account_id' => $idAccount,
                'accepted' => 'true',
                ]);

            DB::commit();
            return 'Успешно';
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json('Ошибка: ' . $e->getMessage(), 500);
        }
    }

}
