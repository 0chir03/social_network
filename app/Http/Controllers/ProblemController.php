<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProblemRequest;
use App\Jobs\YougileProblemJob;
use App\Models\Account;
use App\Service\YougileService;
use Illuminate\Support\Facades\Auth;


class ProblemController
{
    public function getForm()
    {
        return view('problems.problems');
    }


    public function create(ProblemRequest $request, YougileService $yougile)
    {
        $validated = $request->validated();
        $account = Account::query()->where('user_id', '=', Auth::id())->firstOrFail();

        YougileProblemJob::dispatch($validated, $account, $yougile)->onQueue('yougileProb');

        return back()->with('status',  "Проблема направлена на рассмотрение");
    }
}
