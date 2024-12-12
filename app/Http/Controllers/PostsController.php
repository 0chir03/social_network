<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostsRequest;
use Illuminate\Support\Facades\Auth;

class PostsController
{
    public function createPosts(PostsRequest $request)
    {
        $validated = $request->validated();

        Auth::user()->post()->create([
            'body' => $validated['status']
        ]);

        return redirect('/page')->with('info', 'Запись успешно добавлена');
    }
}
