<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PageController
{
    public function showPage()
    {
        /** @var User $user  */
        //запрос данных юзера и аккаунта
        $user = Auth::user();
        $account = $user->account;
        return view('page.account_page', ['user' => $user, 'account' => $account,]);
    }

}
