<?php
    namespace App\Http\Controllers\Api;

    use App\Http\Controllers\Controller;
    use App\Http\Resources\Api\NewItemCollection;
    use App\Services\Api\NewItemService;
    use App\Models\NewItem;
    use App\Traits\HandleResponse;
    use Illuminate\Http\Request;
    use Knuckles\Scribe\Attributes\Group;
    use Knuckles\Scribe\Attributes\QueryParam;
    use Knuckles\Scribe\Attributes\Endpoint;
    use Knuckles\Scribe\Attributes\ResponseFromApiResource;
    use Validator;
    use Auth;

    #[Group("News", "APIs for News")]
    class NewItemController extends Controller
    {
        use HandleResponse;

        public function __construct(NewItemService $NewItemService)
        {
            $this->NewItemService = $NewItemService;
        }


        #[Endpoint("Add a word to the list.","This endpoint return news with pagination")]
        #[QueryParam(name: "per_page", type: "int", description: "Field to return pagination.", required: false, example: 15)]
        #[ResponseFromApiResource(NewItemCollection::class,NewItem::class,collection: true, paginate:15,with:['category'],additional: ["success" => true, "message" => "operation done successfully",'response_code'=>200])]
        public function get(Request $request)
        {
            return $this->NewItemService->get_data($request);
        }
    }
