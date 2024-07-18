<?php

namespace App\Services\Api;

use App\Http\Resources\Api\NewItemCollection;
use App\Models\NewItem;
use App\Traits\HandleResponse;
use Illuminate\Http\Request;
use Validator;

class NewItemService
{
    use HandleResponse;

    public function __construct()
    {

    }

    public function get_data(Request $request)
    {
        $per_page = $request->per_page ? $request->per_page : 10;
        $news = NewItem::where('published', 1)->with('category')->paginate($per_page);
        return $this->send_response(TRUE, 200, __("auth.Successful", [], $request->header('lang')), new NewItemCollection($news));
    }
}
