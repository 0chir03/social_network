<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController
{
    public function createPosts(Request $request)
    {
        $validated = $request->validate([
            'status' => 'required|max:1000',
        ]);

        Auth::user()->post()->create([
            'body' => $request['status']
        ]);

        return redirect('/page')->with('info', 'Запись успешно добавлена');
    }
}
