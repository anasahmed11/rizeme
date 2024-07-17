<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\NewItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class NewItemFactory extends Factory
{
    protected $model = NewItem::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->word,
            'description' => $this->faker->text,
            'image' => $this->faker->imageUrl(),
            'category_id' => Category::factory(),//to make relation with categories
        ];
    }

}
