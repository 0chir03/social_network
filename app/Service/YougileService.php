<?php

namespace App\Service;

use Illuminate\Support\Facades\Http;

class YougileService
{
    public function send(object $msg, string $columnId)
    {
        $msg = json_decode($msg->body);
        Http::withToken('6WxXQlOvkRnkPZyB15XEW3PdSHIp2sOmfPPA2lNoLJ3ZOLXcL2eQCRB+JOgK1lNA')
            ->post('https://ru.yougile.com/api-v2/tasks', [
                'title' => $msg->account->first_name . ' ' . $msg->account->last_name,
                'columnId' => $columnId,
                'description' => $msg->validated->content,
                'color' => 'task-red'
            ]);
        echo "Сообщение доставлено";
    }
}
