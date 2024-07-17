<?php
    namespace Tests\Feature;
    use App\Models\Admin;
    use App\Models\User;
    use Illuminate\Foundation\Testing\DatabaseTransactions;
    use Tests\TestCase;

    class TaskTest extends TestCase
    {
        use DatabaseTransactions;
        public function testSuccessCreateTask()
        {
            $this->beginDatabaseTransaction();
            //create admin and user
            $admin = Admin::factory()->create();
            $user = User::factory()->create();
            //create task using task create function
            $response = $this->post('/task/store', [
                'title' => 'task 1',
                'description' => 'desc task 1',
                'assigned_by_id' => $admin->id,
                'assigned_to_id' => $user->id,
            ]);
            //test if redirect success
            $response->assertStatus(302);
            //test if task table has the task we created
            $this->assertDatabaseHas('tasks', [
                'title' => 'task 1',
                'description' => 'desc task 1',
                'assigned_by_id' => $admin->id,
                'assigned_to_id' => $user->id,
            ]);
        }

        public function testFailedCreateTask()
        {
            $this->beginDatabaseTransaction();
            $admin = Admin::factory()->create();
            $user = User::factory()->create();
            $response = $this->post('/task/store', [
                'title' => '',
                'description' => '',
                'assigned_by_id' => $admin->id,
                'assigned_to_id' => $user->id,
            ]);
            $response->assertStatus(302);
            //test if validation error returned in session
            $response->assertSessionHasErrors('title');
            $response->assertSessionHasErrors('description');
        }
    }
