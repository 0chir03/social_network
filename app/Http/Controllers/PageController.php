<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Service\Decorators\CachePostServiceDecorator;
use App\Service\Decorators\PostServiceInterface;
use Illuminate\Support\Facades\Auth;
;

class PageController
{
    protected $postService;

    public function __construct(PostServiceInterface $postService)
    {
        $this->postService = new CachePostServiceDecorator($postService);
    }
    public function showPage()
    {
        /** @var User $user */
        //запрос данных юзера и аккаунта
        $user = Auth::user();
        $account = $user->account;

        //посты через декоратор кэша
        $posts = $this->postService->getPosts(Auth::id());

        return view('page.account_page', ['user' => $user, 'account' => $account, 'posts' => $posts]);
    }

    public function showMyPage()
    {
        return redirect('/page')->with('success', 'Переход на свою страницу');
    }
}
