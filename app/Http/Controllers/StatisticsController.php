<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public $UserService;

    public function __construct(UserService $UserService)
    {
        $this->UserService = $UserService;
    }

    public function statistics(Request $request)
    {
        return $this->UserService->statistics($request);
    }

}
