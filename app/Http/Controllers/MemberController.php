<?php

namespace App\Http\Controllers;

use App\Events\SubscriberEvent;
use App\Models\Account;
use App\Models\User;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class MemberController
{
    //показывать всех участников
    public function showMembers()
    {
        /** @var User $user  */
        //запрос всех аккаунтов кроме текущего юзера
        $user = Auth::user();
        $accounts = Account::where('id', '!=', $user->account->id)->paginate(5);
        return view('members.members', ['accounts' => $accounts,]);
    }


    //Показывать аккаунт участника
    public function showMemberPage($id)
    {
        $account = Account::find($id);
        return view('members.member_account')->with('account', $account);
    }

    //Показывать друзей и подписчиков аккаунта
    public function showFriendsMember($id)
    {
        $userId = Account::query()->find($id)->user_id;
        $subscribers = Subscriber::query()->where('user_id', $userId)->get();
        return view('subscribers.subscribers')->with('subscribers', $subscribers);
    }

    //Добавить в друзья
    public function addMembers(Request $request)
    {
        //Валидация
        $validated = $request->validate([
            'id' => 'required|integer',
        ]);

        $userId = Auth::id();
        $accountId = $validated['id'];

        //проверка на наличие подписчика
        if (Subscriber::query()->where('user_id', $userId)->where('account_id', $accountId)->exists()) {
            return back()->with('status', "Вы уже подписаны");
        }

        //добавить в друзья
        $subscriber = Subscriber::query()->create([
            'user_id' => $userId,
            'account_id' => $accountId,
            'accepted' => 'false',
        ]);

        return back()->with('status', "Запрос на дружбу отправлен");
    }
}
