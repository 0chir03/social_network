<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportRequest;
use App\Jobs\YougileReportJob;
use App\Jobs\YougileRmReportJob;
use App\Models\Account;
use App\Service\YougileService;
use Illuminate\Support\Facades\Auth;

class ReportController
{
    public function getForm(Account $account)
    {
        return view('report.report')->with('account', $account);
    }

    public function create(ReportRequest $request, Account $account, YougileService $yougile)
    {
        $user = Auth::user();
        $validated = $request->validated();
        YougileReportJob::dispatch($validated, $account, $user, $yougile)->onQueue('yougileRep');
        return back()->with('status',  "Жалоба направлена на рассмотрение");
    }
}
