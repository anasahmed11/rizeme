<?php
    namespace Database\Seeders;

    use App\Models\Category;
    use App\Models\NewItem;
    use App\Models\NewItemComment;
    use Illuminate\Database\Seeder;

    class DatabaseSeeder extends Seeder
    {
        /**
         * Seed the application's database.
         */
        public function run(): void
        {
            $this->call(UsersTableSeeder::class);
            // Create 2 categories with each category has 6 new items and each item has 3 comment
            Category::factory()->count(2)
                ->has(NewItem::factory()->count(6)
                    ->has(NewItemComment::factory()->count(3), 'comments')
                    , 'new_items')
                ->create();
        }
    }
