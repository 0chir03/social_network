<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController
{

    //Показать форму создания аккаунта
    public function showAccountForm()
    {
        return view('account.create');
    }

    //Обработка аккаунта
    public function account(Request $request)
    {
            //Валидация данных
            $validated = $request->validate([
                'firstName' => 'required|string|max:255',
                'lastName' => 'required|string|max:255',
                'dateBirth' => 'required|date',
                'maritalStatus' => 'required|string|max:255',
                'locality' => 'required|string|max:255',
                'career' => 'required|string|max:255',
                'hobby' => 'required|string|max:255',
            ]);

            //Создание аккаунта
            $account = Account::query()->create([
                'user_id' => Auth::id(),
                'first_name' => $validated['firstName'],
                'last_name' => $validated['lastName'],
                'date_of_birth' => $validated['dateBirth'],
                'marital_status' => $validated['maritalStatus'],
                'locality' => $validated['locality'],
                'career' => $validated['career'],
                'hobby' => $validated['hobby'],
            ]);

            //Создание фото для аккаунта
            $account_id = $account->id;
            $photo = Photo::query()->create([
                'account_id' => $account_id,
                'photo_link' => $request->file('file')->store('', 'images'),
            ]);

            return redirect('/page');
    }

}
