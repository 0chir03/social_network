<?php

namespace App\Service\Decorators;

use Illuminate\Support\Facades\Cache;

class CachePostServiceDecorator implements PostServiceInterface
{
    protected $postService;

    public function __construct(PostServiceInterface $postService)
    {
        $this->postService = $postService;
    }

    public function getPosts($userId)
    {
        return Cache::rememberForever('users',  function () use ($userId) {
            return $this->postService->getPosts($userId);
        });
    }
}
