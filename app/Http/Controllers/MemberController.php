<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\User;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class MemberController
{
    public function showMembers()
    {
        /** @var User $user  */
        //запрос всех аккаунтов кроме текущего юзера
        $user = Auth::user();
        $accounts = Account::where('id', '!=', $user->account->id)->paginate(5);
        return view('members.members', ['accounts' => $accounts,]);
    }

    public function showMemberPage($id)
    {

        $account = Account::find($id);
        return view('members.member_account')->with('account', $account);
    }

    public function addMembers(Request $request)
    {
        //Валидация
        $validated = $request->validate([
            'id' => 'required|integer',
        ]);

        //добавить в друзья
        Subscriber::query()->create([
            'user_id' => Auth::id(),
            'account_id' => $validated['id'],
        ]);
        return back()->with('success', 'Запрос на дружбу отправлен!');
    }
}
