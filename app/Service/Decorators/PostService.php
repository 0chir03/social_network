<?php

namespace App\Service\Decorators;

use App\Models\Post;

class PostService implements PostServiceInterface
{
    public function getPosts($userId)
    {
        return Post::all()->where('user_id', '=', $userId);
    }
}
