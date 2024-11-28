<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController
{
    //Показать форму логина
    public function showLoginForm()
    {
        return view('auth.login');
    }


    //Обработка входа
    public function login(LoginRequest $request)
    {
        //Валидация данных
        $credentials = $request->validated();

        //Попытка аутентификации
        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
            //Аутентификация успешна и переход на личную страницу, если таковая есть
            $id = Account::query()->where('user_id', Auth::id())->value('user_id');
            if (!empty($id)) {
                return redirect()->to('/page');
            }
            //Аутентификация успешна и переход на создание аккаунта
            return redirect()->to('/account');
        }
        //Если логин неудачен, возвращаемся с ошибкой
        return back()->withErrors(['email' => "Неверный email или пароль.",])->onlyInput('email');
    }

    //Обработка выхода
    public  function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('success', 'Вы вышли из системы');
    }
}
