<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class PageController
{
    public function showPage()
    {
        /** @var User $user */
        //запрос данных юзера и аккаунта
        $user = Auth::user();
        $account = $user->account;

        //посты пользователя
        $posts = Cache::rememberForever('users',  function () {
            return Post::all()->where('user_id', '=', Auth::id());
        });

        return view('page.account_page', ['user' => $user, 'account' => $account, 'posts' => $posts]);
    }

    public function showMyPage()
    {
        return redirect('/page')->with('success', 'Переход на свою страницу');
    }

}
