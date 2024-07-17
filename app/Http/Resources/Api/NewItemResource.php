<?php
    namespace App\Http\Resources\Api;

    use Illuminate\Http\Resources\Json\JsonResource;
    use Illuminate\Support\Facades\URL;

    class NewItemResource extends JsonResource
    {
        /**
         * Transform the resource into an array.
         *
         * @param \Illuminate\Http\Request $request
         * @return array
         */
        public function toArray($request)
        {
            return [
                'id' => $this->id,
                'title' => $this->title,
                'description' => $this->description,
                'category' => $this->category?$this->category->name:null,
                'image' => $this->image ? '' . URL::to('/') . '/storage/' . $this->image : '',
            ];
        }
    }
