<?php
    namespace Tests\Feature;

    use App\Models\Admin;
    use App\Models\Category;
    use App\Models\NewItem;
    use App\Models\NewItemComment;
    use App\Models\User;
    use Illuminate\Foundation\Testing\DatabaseTransactions;
    use Tests\TestCase;

    class NewsApiTest extends TestCase
    {
        use DatabaseTransactions;

        public function testSuccessReturn()
        {
            //begin transaction to make this only for test
            $this->beginDatabaseTransaction();
            Category::factory()->count(2)
                ->has(NewItem::factory()->count(6)
                    ->has(NewItemComment::factory()->count(3), 'comments')
                    , 'new_items')
                ->create();
            $response = $this->json('GET', '/api/news'); //get response

            // Assert HTTP status code
            $response->assertStatus(200);

            // Assert the success field is true
            $response->assertJson(['success' => true]);
            $response->assertJson(['response_code' => 200]);
            // Assert JSON structure and values
            $response->assertJsonStructure([
                'success',
                'response_code',
                'message',
                'data' => [
                    'data' => [
                        '*' => [
                            'id',
                            'title',
                            'description',
                            'category',
                            'image',
                        ],
                    ],
                    'pagination' => [
                        'total',
                        'count',
                        'per_page',
                        'current_page',
                        'total_pages',
                        'is_pagination',
                    ],
                ],
            ]);
        }

    }
