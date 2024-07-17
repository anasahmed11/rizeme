<?php

namespace App\Services;

use App\Models\Admin;
use Validator;

class AdminService
{

    public function __construct()
    {

    }

    public function all_admins()
    {
        return Admin::all();
    }
}
