<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegistrationController
{
    //Показать форму регистрации
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    //Обработка регистрации
    public function register(RegistrationRequest $request)
    {
        //Валидация данных
        $validated = $request->validated();

        //Создаем пользователя
        $user = User::query()->create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'phone' => $validated['phone'],
        ]);

        return redirect('/')->with('success', 'Регистрация успешна');
    }
}
