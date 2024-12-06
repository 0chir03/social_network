<?php

namespace App\Service;

use Illuminate\Support\Facades\Http;

class YougileService
{

    private $token;
    private $url;
    private $columnId;

    /**
     * @param $token
     * @param $url
     * @param $columnId
     */
    public function __construct()
    {
        $this->token = config('services.yougile.token');
        $this->url = config('services.yougile.url');
        $this->columnId = config('services.yougile.column_id.column1');
    }


    public function createReport(array $validated, object $account, object $user): void
    {
        Http::withToken($this->token)
            ->post(($this->url), [
                'title' => $account->first_name . ' ' . $account->last_name,
                'columnId' => $this->columnId,
                'description' => $user->name . ' ' . $user->email . ': ' . $validated['content'],
                'color' => 'task-red'
            ]);
    }

    public function createProblem(array $validated, object $account)
    {
        Http::withToken($this->token)
            ->post($this->url, [
                'title' => $account->first_name . ' ' . $account->last_name,
                'columnId' => $this->columnId,
                'description' => $validated['content'],
                'color' => 'task-red'
            ]);
    }
}
