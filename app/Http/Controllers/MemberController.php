<?php

namespace App\Http\Controllers;

use App\Http\Requests\MemberRequest;
use App\Models\Account;
use App\Models\User;
use App\Models\Subscriber;
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
        $subscribers = Subscriber::query()->where('user_id', $userId)->paginate(5);
        return view('subscribers.subscribers')->with('subscribers', $subscribers);
    }

    //Добавить в друзья
    public function addMembers(MemberRequest $request)
    {
        //Валидация
        $validated = $request->validated();

        $userId = Auth::id();
        $accountId = $validated['id'];

        //проверка на наличие подписчика
        if (Subscriber::query()->where('user_id', $userId)->where('account_id', $accountId)->exists()) {
            return "Вы уже подписаны";
        }

        //добавить в друзья
        $subscriber = Subscriber::query()->create([
            'user_id' => $userId,
            'account_id' => $accountId,
            'accepted' => 'false',
        ]);

        return "Запрос на дружбу отправлен";
    }
}
