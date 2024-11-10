<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    //Показать форму регистрации
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    //Обработка регистрации
    public function register(Request $request)
    {
        //Валидация данных
        $validated = $request->validate([
           'name' => 'required|string|max:255',
           'email' => 'required|string|email|max:255|unique:users',
           'password' => 'required|string|min:8|confirmed',
           'phone' => 'nullable|string|max:15',
        ]);

        //Создаем пользователя
        $user = (new \App\Models\User())->create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'phone' => $validated['phone'],
        ]);

        return redirect('/')->with('success', 'Регистрация успешна');
    }
}
