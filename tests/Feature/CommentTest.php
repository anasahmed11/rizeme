<?php
    namespace Tests\Feature;
    use App\Models\Admin;
    use App\Models\NewItem;
    use App\Models\User;
    use Illuminate\Foundation\Testing\DatabaseTransactions;
    use Tests\TestCase;

    class CommentTest extends TestCase
    {
        use DatabaseTransactions;
        public function testSuccessCreateComment()
        {
            $this->beginDatabaseTransaction();
            // Create a news item (assuming you have a NewsItem model and its relationships set up)
            $newItem = NewItem::factory()->create();

            // Define the data you want to submit for storing the comment
            $data = [
                'new_item_id' => $newItem->id,
                'comment' => 'test',
            ];
            $response = $this->postJson(route('new.comment',$newItem->id), $data);
            //test if redirect success
            $response->assertStatus(302);
            //test if comments table has the comment we created
            $this->assertDatabaseHas('new_item_comments', [
                'new_item_id' => $newItem->id,
                'comment' => 'test',
            ]);
        }

        public function testFailedCreateComment()
        {
            $this->beginDatabaseTransaction();
            // Create a news item (assuming you have a NewsItem model and its relationships set up)
            $newItem = NewItem::factory()->create();

            // Define the data you want to submit for storing the comment
            $data = [
                'new_item_id' => $newItem->id,
                'comment' => '',
            ];
            $response = $this->postJson(route('new.comment',$newItem->id), $data);
            //test if redirect success
            $response->assertStatus(302);
            //test if validation error returned in session
            $response->assertSessionHasErrors('comment');
        }
    }
