<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportRequest;
use App\Models\Account;
use App\Service\RabbitMQService;
class ReportController
{
    public function getForm(Account $account)
    {
        return view('report.report')->with('account', $account);
    }

    public function create(ReportRequest $request, Account $account)
    {
        $validated = $request->validated();
        $queue = 'yougile';

        $data = json_encode([
            'account' => $account,
            'validated' => $validated,
        ]);

        $service = new RabbitMQService;
        $service->produce($queue, $data);

        return back()->with('status',  "Жалоба направлена на рассмотрение");
    }
}
