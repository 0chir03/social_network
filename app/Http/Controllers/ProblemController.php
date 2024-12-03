<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProblemRequest;
use App\Jobs\ProblemJob;
use App\Models\Account;
use App\Service\RabbitMQService;
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

        $data = ([
            'account' => Account::query()->where('user_id', '=', Auth::id())->firstOrFail(),
            'validated' => $validated
        ]);

        //$service = new RabbitMQService;
        //$service->produce($queue, $data);

        ProblemJob::dispatch($data)->onQueue($queue);

        return back()->with('status',  "Проблема направлена на рассмотрение");
    }
}
