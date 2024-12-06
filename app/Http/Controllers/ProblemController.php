<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProblemRequest;
use App\Jobs\YougileProblemJob;
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
        $account = Account::query()->where('user_id', '=', Auth::id())->firstOrFail();

        YougileProblemJob::dispatch($validated, $account)->onQueue('yougileProb');

        return back()->with('status',  "Проблема направлена на рассмотрение");
    }
}
