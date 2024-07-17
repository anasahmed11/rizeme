<?php
    namespace App\Http\Controllers\Api;

    use App\Http\Controllers\Controller;
    use App\Services\Api\NewItemService;
    use App\Traits\HandleResponse;
    use Illuminate\Http\Request;
    use Validator;
    use Auth;

    class NewItemController extends Controller
    {
        use HandleResponse;

        public function __construct(NewItemService $NewItemService)
        {
            $this->NewItemService = $NewItemService;
        }

        public function get(Request $request)
        {
            return $this->NewItemService->get_data($request);
        }

    }
