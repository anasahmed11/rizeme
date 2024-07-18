<?php

namespace App\Http\Controllers;

use App\Services\NewItemService;
use Illuminate\Http\Request;

class NewItemController extends Controller
{

    public function __construct(NewItemService $NewItemService)
    {
        $this->NewItemService = $NewItemService;
    }

    public function index(Request $request)
    {
        return $this->NewItemService->index($request);
    }

    public function comments($id)
    {
        return $this->NewItemService->comments($id);
    }

    public function newComment(Request $request,$id)
    {
        return $this->NewItemService->newComment( $request,$id);
    }
}
