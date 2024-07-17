<?php

namespace App\Http\Controllers;

use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public $TaskService;

    public function __construct(TaskService $TaskService)
    {
        $this->TaskService = $TaskService;
    }

    public function store(Request $request)
    {
        return $this->TaskService->save($request);
    }

    public function create(Request $request)
    {
        return $this->TaskService->create($request);
    }

    public function index(Request $request)
    {
        return $this->TaskService->get_data($request);
    }

}
