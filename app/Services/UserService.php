<?php

namespace App\Services;

use App\Jobs\IncrementTaskCount;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;

class UserService
{

    public function __construct()
    {

    }

    public function increment_task_count($id)
    {
        $user = User::where('id', $id)->first();
        if ($user) {
            $user->task_count += 1;
            $user->save();
        }
    }

    public function increment_task_count_job($id)
    {
        // Dispatch the IncrementTaskCount job and capture the return value
        $jobDispatched = IncrementTaskCount::dispatch($id);
        // Check if not dispatched force increment task count
        if (!$jobDispatched) {
            $this->increment_task_count($id);
        }
    }

    public function all_users()
    {
        return User::all();
    }

    public function statistics(Request $request)
    {
        $users = User::orderByDesc('task_count')->take(10)->get();
        return view('statistics.index', compact('users'));
    }
}
