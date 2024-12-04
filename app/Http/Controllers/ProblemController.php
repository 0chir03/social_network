<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProblemRequest;
use App\Jobs\YougileJob;
use App\Models\Account;
use Illuminate\Support\Facades\Auth;


class ProblemController
{
    public function getForm()
    {
        return view('problems.problems');
    }


    public function create(ProblemRequest $request)
    {
        $validated = $request->validated();
        $queue = 'yougileProb';
        $account = Account::query()->where('user_id', '=', Auth::id())->firstOrFail();
        $columnId = '7b9e60b5-6b40-4ea3-aa6d-06c0c01f4168';

        YougileJob::dispatch($validated, $account, $columnId)->onQueue($queue);

        return back()->with('status',  "Проблема направлена на рассмотрение");
    }
}
