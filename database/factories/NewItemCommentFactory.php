<?php

namespace Database\Factories;

use App\Models\NewItem;
use App\Models\NewItemComment;
use Illuminate\Database\Eloquent\Factories\Factory;

class NewItemCommentFactory extends Factory
{
    protected $model = NewItemComment::class;

    public function definition(): array
    {
        return [
            'new_item_id' => NewItem::factory(),//to make relation with news
            'comment' => $this->faker->paragraph,
        ];
    }

}
