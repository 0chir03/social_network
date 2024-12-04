<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportRequest;
use App\Jobs\YougileJob;
use App\Models\Account;
class ReportController
{
    public function getForm(Account $account)
    {
        return view('report.report')->with('account', $account);
    }

    public function create(ReportRequest $request, Account $account)
    {
        $validated = $request->validated();
        $queue = 'yougileRep';
        $columnId = '190ff3c1-7098-40d9-a046-3080a20fce07';

        YougileJob::dispatch($validated, $account, $columnId)->onQueue($queue);

        return back()->with('status',  "Жалоба направлена на рассмотрение");
    }
}
