<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Http\Request;
use Validator;

class TaskService
{

    public function __construct(UserService $UserService, AdminService $AdminService)
    {
        $this->UserService = $UserService;
        $this->AdminService = $AdminService;
    }

    public function create()
    {
        $admins = $this->AdminService->all_admins();
        $users = $this->UserService->all_users();
        return view('task.create')->with(compact('admins', 'users'));
    }

    public function validate(Request $request)
    {
        return Validator::make($request->all(), [
            'title' => 'required|min:3|max:255',
            'description' => 'required|min:3',
            'assigned_by_id' => 'required|exists:admins,id',
            'assigned_to_id' => 'required|exists:users,id',
        ])->validate();

    }

    public function save(Request $request)
    {
        //validate the request
        $this->validate($request);
        //create the task
        $task = new Task();
        $task->assigned_to_id = $request->assigned_to_id;
        $task->assigned_by_id = $request->assigned_by_id;
        $task->title = $request->title;
        $task->description = $request->description;
        $task->save();

        //increment user task count to help us in statistics using job
        $this->UserService->increment_task_count_job($request->assigned_to_id);
        //redirect to tasks page
        return redirect('/tasks');
    }


    public function get_data(Request $request)
    {
        $tasks = Task::with('admin', 'user')->orderByDesc('id')->paginate(10);
        return view('task.index', compact('tasks'));
    }
}
