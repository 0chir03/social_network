<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PageController
{
    public function showPage()
    {
        /** @var User $user */
        //запрос данных юзера и аккаунта
        $user = Auth::user();
        $account = $user->account;

        //посты пользователя
        $posts = Post::all()->where('user_id', '=', Auth::id());

        return view('page.account_page', ['user' => $user, 'account' => $account, 'posts' => $posts]);
    }

    public function showMyPage()
    {
        return redirect('/page')->with('success', 'Переход на свою страницу');
    }

}
