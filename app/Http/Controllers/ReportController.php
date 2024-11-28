<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportRequest;
use App\Models\Account;
use Illuminate\Support\Facades\Http;

class ReportController
{
    public function getForm(Account $account)
    {
        return view('report.report')->with('account', $account);
    }


    public function create(ReportRequest $request, Account $account)
    {
        $validated = $request->validated();

        Http::withToken('6WxXQlOvkRnkPZyB15XEW3PdSHIp2sOmfPPA2lNoLJ3ZOLXcL2eQCRB+JOgK1lNA')
            ->post('https://ru.yougile.com/api-v2/tasks', [
                'title' => $account->first_name . ' ' . $account->last_name,
                'columnId' => '190ff3c1-7098-40d9-a046-3080a20fce07',
                'description' => $validated['content'],
                'color' => 'task-red'
            ]);

        return redirect('/members/23/profile')->with('info', 'Жалоба отправлена');
    }
}
